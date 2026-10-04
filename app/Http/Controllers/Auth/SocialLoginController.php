<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialLoginController extends Controller
{
    public function redirectToProvider(String $provider)
    {
        return \Socialite::driver($provider)
            ->redirectUrl($this->callbackUrl($provider))
            ->redirect();
    }

    public function providerCallback(String $provider)
    {
        try {
            // Same redirect_uri as the outbound leg — OAuth requires the value at token
            // exchange to match the one sent at authorization.
            $social_user = \Socialite::driver($provider)
                ->redirectUrl($this->callbackUrl($provider))
                ->user();

            // Restrictions are re-applied on every sign-in rather than only at provisioning,
            // so removing someone from a group upstream ends their access here too.
            if ($denied = $this->authorizationError($provider, $social_user)) {
                return redirect()->route('login')->withErrors($denied);
            }

            $profile = $this->profile($provider, $social_user);

            // 1) Primary identity match is the immutable provider subject id (OIDC `sub`),
            //    never the email — an email can be reassigned upstream and must not be a
            //    login key on its own.
            $account = SocialAccount::where([
                'provider_name' => $provider,
                'provider_id'   => $social_user->getId(),
            ])->first();

            if ($account) {
                $this->syncProfile($account->user, $provider, $profile);
                $this->applyAdminGroup($account->user, $provider, $profile);
                auth()->login($account->user);
                $this->rememberSsoSession($provider, $social_user);

                return redirect('/studio/index');
            }

            // Beyond this point we fall back to the email to bridge/provision an account,
            // so an email is required and — to avoid account takeover via an unverified,
            // attacker-controlled address — it must be verified by the provider.
            $email = $social_user->getEmail();

            if (empty($email)) {
                return redirect()->route('login')->withErrors(
                    __('messages.Your identity provider did not release an email address.')
                );
            }

            if ($this->flag($provider, 'require_verified_email', true) && $this->emailIsUnverified($social_user)) {
                return redirect()->route('login')->withErrors(
                    __('messages.Your email address is not verified with the identity provider.')
                );
            }

            // 2) Bridge to an existing local user by (verified) email, else 3) provision a
            //    new user mirroring the shape of a locally-registered account (role, block,
            //    a hashed random password, a valid unique slug). The two are separately
            //    refusable, so an instance can permit one without the other.
            $user = User::where('email', $email)->first();

            if ($user && ! $this->flag($provider, 'link_existing_user', true)) {
                return redirect()->route('login')->withErrors(
                    __('messages.An account with this email address already exists.')
                );
            }

            if (! $user) {
                if (! $this->flag($provider, 'auto_register', true)) {
                    return redirect()->route('login')->withErrors(
                        __('messages.This instance does not create accounts from single sign-on.')
                    );
                }

                $user = User::create([
                    'name'              => $profile['name'] ?: Str::before($email, '@'),
                    'email'             => $email,
                    'image'             => $profile['avatar'],
                    'littlelink_name'   => $this->uniqueLittlelinkName(
                        $profile['username'] ?: Str::before($email, '@')
                    ),
                    'password'          => Hash::make(Str::random(64)),
                    'email_verified_at' => now(),
                ]);

                $user->role  = 'user';
                $user->block = env('MANUAL_USER_VERIFICATION') == true ? 'yes' : 'no';
                $user->save();
            }

            $this->applyAdminGroup($user, $provider, $profile);

            // Link the social identity so subsequent logins match on the immutable sub.
            $user->socialAccounts()->create([
                'provider_id'   => $social_user->getId(),
                'provider_name' => $provider,
            ]);

            auth()->login($user);
            $this->rememberSsoSession($provider, $social_user);

            return redirect('/studio/index');
        } catch (\Throwable $e) {
            return redirect()->route('login')->withErrors($e->getMessage());
        }
    }

    /**
     * OAuth callback URL for a provider.
     *
     * A redirect the operator configured for the provider wins — that stays proxy-immune
     * and honours non-standard callback paths, so no existing setup regresses. Otherwise
     * the URL is derived from the current request host, so one instance serves every
     * apex/domain it answers on with no per-domain configuration (each apex's callback
     * must be registered with the provider; the derive path expects TrustProxies to be
     * set when running behind a reverse proxy). Resolved per request, so config:cache-safe.
     */
    protected function callbackUrl(string $provider): string
    {
        $configured = config('services.'.$provider.'.redirect');

        if (! empty($configured) && $configured !== 'http://example.com/callback-url') {
            return $configured;
        }

        return url('/social-auth/'.$provider.'/callback');
    }

    /**
     * Post-logout landing for RP-initiated logout. The IdP redirects here after ending its
     * session; validate the state logout() minted (consumed on first use, so replays fail),
     * then complete the local logout. Fails closed if the state can't be validated.
     */
    public function logoutCallback(Request $request)
    {
        $oidc = $request->session()->get('oidc_logout');
        $provider = is_array($oidc) && ! empty($oidc['provider']) ? $oidc['provider'] : 'openidconnect';

        try {
            if (! \Socialite::driver($provider)->validateLogoutState($request)) {
                abort(403);
            }
        } catch (\Throwable $e) {
            abort(403);
        }

        auth()->guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Whether the provider is an OpenID Connect connection. The controls below are specific
     * to it — the built-in providers have a fixed profile shape and release no claims.
     */
    protected function isOidc(string $provider): bool
    {
        return Str::startsWith($provider, ['oidc', 'openidconnect']);
    }

    /**
     * A boolean control from the provider's services entry.
     */
    protected function flag(string $provider, string $key, bool $default): bool
    {
        if (! $this->isOidc($provider)) {
            return $default;
        }

        return filter_var(config('services.'.$provider.'.'.$key, $default), FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * A configured list, in the order entries should be tried. Written as a comma-separated
     * string or an array; both are accepted because a .env can only express the former.
     */
    protected function listConfig(string $provider, string $key, string $default): array
    {
        $configured = config('services.'.$provider.'.'.$key, $default);
        $configured = is_array($configured) ? $configured : explode(',', (string) $configured);

        return array_values(array_filter(array_map('trim', $configured), static fn ($v) => $v !== ''));
    }

    /**
     * First claim in $names that the provider actually released.
     */
    protected function claim(array $raw, array $names): ?string
    {
        foreach ($names as $name) {
            $value = $raw[$name] ?? null;

            if (is_scalar($value) && (string) $value !== '') {
                return (string) $value;
            }
        }

        return null;
    }

    protected function rawClaims($social_user): array
    {
        return method_exists($social_user, 'getRaw') ? (array) $social_user->getRaw() : [];
    }

    /**
     * Profile fields for a social user.
     *
     * Socialite's accessors suit the built-in providers, whose profile shape is fixed.
     * OpenID Connect's is not: providers disagree over which claim carries a username, a
     * display name is sometimes only given_name/family_name, and the driver maps neither
     * preferred_username nor picture at all. So for OIDC every field is read from a
     * configurable list of claims, the first one present winning. The defaults are the
     * standard OIDC claims, which is what most providers release.
     */
    protected function profile(string $provider, $social_user): array
    {
        if (! $this->isOidc($provider)) {
            return [
                'name'     => $social_user->getName(),
                'username' => $social_user->getNickname(),
                'avatar'   => $social_user->getAvatar(),
                'groups'   => [],
            ];
        }

        $raw  = $this->rawClaims($social_user);
        $name = $this->claim($raw, $this->listConfig($provider, 'name_claim', 'name'));

        if (empty($name)) {
            // No display-name claim: compose one from the standard name parts.
            $name = trim(($raw['given_name'] ?? '').' '.($raw['family_name'] ?? '')) ?: null;
        }

        return [
            'name'     => $name ?: $social_user->getName(),
            'username' => $this->claim($raw, $this->listConfig($provider, 'username_claim', 'preferred_username,nickname'))
                ?: $social_user->getNickname(),
            'avatar'   => $this->claim($raw, $this->listConfig($provider, 'picture_claim', 'picture'))
                ?: $social_user->getAvatar(),
            'groups'   => $this->groups($provider, $raw),
        ];
    }

    /**
     * Group memberships from whichever claim carries them. A list and a comma-separated
     * string are both accepted, since providers send both shapes.
     */
    protected function groups(string $provider, array $raw): array
    {
        foreach ($this->listConfig($provider, 'groups_claim', 'groups') as $name) {
            $value = $raw[$name] ?? null;

            if (is_array($value)) {
                return array_values(array_map('strval', array_filter($value, 'is_scalar')));
            }

            if (is_scalar($value) && (string) $value !== '') {
                return array_values(array_filter(array_map('trim', explode(',', (string) $value)), static fn ($v) => $v !== ''));
            }
        }

        return [];
    }

    /**
     * Who may sign in. Both lists are empty by default, which is no restriction at all;
     * naming either one turns it into the allow-list for this instance.
     */
    protected function authorizationError(string $provider, $social_user): ?string
    {
        if (! $this->isOidc($provider)) {
            return null;
        }

        $refused = __('messages.Your account is not permitted to sign in to this instance.');

        if ($domains = $this->listConfig($provider, 'allowed_domains', '')) {
            $email  = (string) $social_user->getEmail();
            $domain = Str::lower(Str::after($email, '@'));

            if ($email === '' || ! in_array($domain, array_map('strtolower', $domains), true)) {
                return $refused;
            }
        }

        if ($allowed = $this->listConfig($provider, 'allowed_groups', '')) {
            if (! array_intersect($allowed, $this->groups($provider, $this->rawClaims($social_user)))) {
                return $refused;
            }
        }

        return null;
    }

    /**
     * Mirror the instance's admin role onto an identity-provider group when one is named.
     * Unset — the default — the role stays entirely the instance's own business. Membership
     * is re-read on every sign-in so a grant can be withdrawn upstream, with the first
     * account exempt so an instance can never be locked out of its own admin panel.
     */
    protected function applyAdminGroup(User $user, string $provider, array $profile): void
    {
        $group = (string) config('services.'.$provider.'.admin_group', '');

        if (! $this->isOidc($provider) || $group === '' || (int) $user->id === 1) {
            return;
        }

        $role = in_array($group, $profile['groups'], true) ? 'admin' : 'user';

        if ($user->role !== $role) {
            $user->role = $role;
            $user->save();
        }
    }

    /**
     * Refresh the stored profile from the provider on each sign-in. Off by default, so
     * whatever a user edited locally stands; on, the provider is authoritative.
     */
    protected function syncProfile(User $user, string $provider, array $profile): void
    {
        if (! $this->flag($provider, 'update_profile_on_login', false)) {
            return;
        }

        if (! empty($profile['name'])) {
            $user->name = $profile['name'];
        }

        if (! empty($profile['avatar'])) {
            $user->image = $profile['avatar'];
        }

        if ($user->isDirty()) {
            $user->save();
        }
    }

    /**
     * True only when the provider explicitly asserts the email is NOT verified. A missing
     * claim is treated as verified so providers that never send `email_verified` still work.
     */
    protected function emailIsUnverified($social_user): bool
    {
        $claims = $this->rawClaims($social_user);

        if (! array_key_exists('email_verified', $claims)) {
            return false;
        }

        return ! filter_var($claims['email_verified'], FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Derive a slug that satisfies the same rules registration enforces
     * (max 50, unique, /^[\p{L}0-9-_]+$/u), disambiguating on collision.
     */
    protected function uniqueLittlelinkName(string $seed): string
    {
        $base = preg_replace('/[^\p{L}0-9\-_]/u', '', $seed);
        $base = $base !== '' ? mb_substr($base, 0, 50) : 'user';

        $name = $base;
        $suffix = 1;

        while (User::where('littlelink_name', $name)->exists()) {
            $tail = '-'.$suffix++;
            $name = mb_substr($base, 0, 50 - mb_strlen($tail)).$tail;
        }

        return $name;
    }

    /**
     * Stash the OIDC id_token so logout can perform an RP-initiated end-session round-trip.
     */
    protected function rememberSsoSession(string $provider, $social_user): void
    {
        if (! $this->isOidc($provider) || ! $this->flag($provider, 'idp_logout', true)) {
            return;
        }

        session()->put('oidc_logout', [
            'provider' => $provider,
            'id_token' => $social_user->accessTokenResponseBody['id_token'] ?? null,
        ]);
    }
}
