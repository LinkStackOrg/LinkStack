<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id'     => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect'      => env('FACEBOOK_CALLBACK_URL'),
    ],
    'twitter' => [
        'client_id'     => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect'      => env('TWITTER_CALLBACK_URL'),
    ],
    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect'      => env('GOOGLE_CALLBACK_URL'),
    ],
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => 'http://example.com/callback-url',
    ],

    // Generic OpenID Connect (socialiteproviders/openidconnect), driver "openidconnect".
    // Points at any OIDC issuer via discovery ({OIDC_ISSUER}/.well-known/openid-configuration).
    // Every id_token is validated (signature/iss/aud/azp/exp/nonce/at_hash) with PKCE and
    // automatic JWKS key-rotation.
    'openidconnect' => [

        // ── Connection ──────────────────────────────────────────────────────────────
        'base_url'      => env('OIDC_ISSUER'),
        'client_id'     => env('OIDC_CLIENT_ID'),
        'client_secret' => env('OIDC_CLIENT_SECRET'),
        'scopes'        => env('OIDC_SCOPES', 'openid profile email'),

        // Deliberately no fallback: SocialLoginController derives the callback from the
        // request host when this is empty, which is what lets one instance serve several
        // apexes. Defaulting it to APP_URL makes that derivation unreachable and sends
        // every visitor back to a single domain.
        'redirect'                 => env('OIDC_REDIRECT_URI'),
        'post_logout_redirect_uri' => env('OIDC_POST_LOGOUT_REDIRECT_URI', env('APP_URL')),

        // Shown on the sign-in button, as "Sign in with {display_name}". The icon is a
        // Bootstrap Icons class, as used elsewhere on the page; set it empty for no icon.
        'display_name' => env('OIDC_DISPLAY_NAME', 'OpenID Connect'),
        'icon'         => env('OIDC_ICON', 'bi-shield-lock'),

        // ── Claim mapping ───────────────────────────────────────────────────────────
        // Providers disagree over which claim carries which field, so each accepts a
        // comma-separated list and the first claim actually released wins. Defaults are
        // the standard OIDC claims. `email_claims` is read by the driver itself, which is
        // why it is the one plural name here.
        'email_claims'   => env('OIDC_EMAIL_CLAIM', 'email'),
        'username_claim' => env('OIDC_USERNAME_CLAIM', 'preferred_username,nickname'),
        'name_claim'     => env('OIDC_NAME_CLAIM', 'name'),
        'picture_claim'  => env('OIDC_PICTURE_CLAIM', 'picture'),
        'groups_claim'   => env('OIDC_GROUPS_CLAIM', 'groups'),

        // ── Provisioning ────────────────────────────────────────────────────────────
        'auto_register'      => filter_var(env('OIDC_AUTO_REGISTER', true), FILTER_VALIDATE_BOOLEAN),
        'link_existing_user' => filter_var(env('OIDC_LINK_EXISTING_USER', true), FILTER_VALIDATE_BOOLEAN),

        // An unverified address must not bridge to an existing account, or anyone able to
        // set an email at the provider could take one over.
        'require_verified_email'  => filter_var(env('OIDC_REQUIRE_VERIFIED_EMAIL', true), FILTER_VALIDATE_BOOLEAN),
        'update_profile_on_login' => filter_var(env('OIDC_UPDATE_PROFILE_ON_LOGIN', false), FILTER_VALIDATE_BOOLEAN),
        'require_email'           => filter_var(env('OIDC_REQUIRE_EMAIL', false), FILTER_VALIDATE_BOOLEAN),

        // ── Authorization ───────────────────────────────────────────────────────────
        // Empty places no restriction; naming either list makes it the allow-list, and it
        // is re-checked on every sign-in so access can be withdrawn upstream. admin_group
        // unset leaves the role entirely to the instance.
        'allowed_groups'  => env('OIDC_ALLOWED_GROUPS', ''),
        'allowed_domains' => env('OIDC_ALLOWED_DOMAINS', ''),
        'admin_group'     => env('OIDC_ADMIN_GROUP', ''),

        // ── Sign-in flow ────────────────────────────────────────────────────────────
        // auto_launch sends /login straight to the provider; ?local=1 still reaches the
        // form, so an instance that sets it can never lock out its local accounts.
        'auto_launch' => filter_var(env('OIDC_AUTO_LAUNCH', false), FILTER_VALIDATE_BOOLEAN),
        // idp_logout ends the provider's session as well, which signs the user out of every
        // other application relying on it. Off by default: a sign-out here should not reach
        // beyond here unless an operator asks for it.
        'idp_logout'  => filter_var(env('OIDC_IDP_LOGOUT', false), FILTER_VALIDATE_BOOLEAN),
    ],

];
