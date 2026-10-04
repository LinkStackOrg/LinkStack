<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SocialAccount;

class SocialLoginController extends Controller
{
    public function redirectToProvider(String $provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    public function providerCallback(String $provider)
    {
        try {
            $social_user = \Socialite::driver($provider)->user();

            // First Find Social Account
            $account = SocialAccount::where([
                'provider_name' => $provider,
                'provider_id' => $social_user->getId()
            ])->first();

            // If Social Account Exist then Find User and Login
            if ($account) {
                auth()->login($account->user);
                return redirect('/studio/index');
            }

            // Find User
            $user = User::where([
                'email' => $social_user->getEmail()
            ])->first();

            // If User not found, then create new user
            if (!$user) {
                $pattern = validation_disallowed_regex();

                // Email: ensure something unique and valid
                $email = $social_user->getEmail();
                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $email = $provider . '_' . $social_user->getId() . '@missing.social';
                }

                // Name: sanitize and trim, remove disallowed chars/phrases
                $name = trim((string) $social_user->getName());
                if ($name === '') {
                    $name = strtok($email, '@');
                }
                $name = preg_replace($pattern, '', $name);
                $name = mb_substr($name, 0, 255);


                // littlelink_name (handle): try nickname, sanitize to allowed chars and enforce lengths
                $nickname = (string) $social_user->getNickname();
                $nickname = preg_replace('/[^\\p{L}0-9-_]/u', '', $nickname);
                $nickname = preg_replace($pattern, '', $nickname);
                if ($nickname === '') {
                    $nickname = preg_replace('/[^\\p{L}0-9-_]/u', '', strtok($name, ' '));
                }

                $handleMin = validation_handle_min();
                $handleMax = validation_handle_max();

                if (mb_strlen($nickname) < $handleMin) {
                    $nickname .= mt_rand(1000, 9999);
                }
                $nickname = mb_substr($nickname, 0, $handleMax);

                $origNickname = $nickname ?: 'user';
                $counter = 0;
                while (User::where('littlelink_name', $nickname)->exists()) {
                    $counter++;
                    $candidate = $origNickname . $counter;
                    $candidate = mb_substr($candidate, 0, $handleMax);
                    $nickname = $candidate;
                    if ($counter > 1000) {
                        $nickname = $origNickname . time();
                        $nickname = mb_substr($nickname, 0, $handleMax);
                        break;
                    }
                }

                // Image: accept only allowed image extensions from configured validation
                $avatar = $social_user->getAvatar();
                $image = null;
                if (!empty($avatar)) {
                    $path = parse_url($avatar, PHP_URL_PATH) ?: '';
                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    if (in_array($ext, validation_image_extensions(), true)) {
                        $image = $avatar;
                    }
                }

                // enforce email max length
                $emailMax = validation_email_max();
                if (mb_strlen($email) > $emailMax) {
                    $email = mb_substr($email, 0, $emailMax);
                }

                $user = User::create([
                    'email' => $email,
                    'name' => $name,
                    'image' => $image,
                    'littlelink_name' => $nickname,
                    'email_verified_at' => now(),
                ]);
            }

            // Create Social Accounts
            $user->socialAccounts()->create([
                'provider_id' => $social_user->getId(),
                'provider_name' => $provider
            ]);

            // Login
            auth()->login($user);
            return redirect('/studio/index');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors($e->getMessage());
        }
    }
}



