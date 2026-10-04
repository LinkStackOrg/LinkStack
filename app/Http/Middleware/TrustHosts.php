<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * One instance may serve several apexes, and the OIDC redirect is derived from the
     * incoming host so each visitor returns to the domain they arrived on. That derivation
     * is only safe while the host itself is trusted — an unchecked Host header would let a
     * forged request aim the authorization redirect at somebody else's domain.
     *
     * Configured by ALLOWED_HOSTS, read through config so a cached config keeps working.
     * Left unset the behaviour is unchanged: the application URL's domain and subdomains,
     * which is what a single-domain instance wants.
     *
     * @return array
     */
    public function hosts()
    {
        $configured = (array) config('app.allowed_hosts', []);

        if (empty($configured)) {
            return [
                $this->allSubdomainsOfApplicationUrl(),
            ];
        }

        return array_map(static function (string $host): string {
            // Already a pattern — Symfony matches these as regex, so pass it through.
            if (str_starts_with($host, '^') || str_ends_with($host, '$')) {
                return $host;
            }

            return '^'.preg_quote($host, '#').'$';
        }, $configured);
    }
}
