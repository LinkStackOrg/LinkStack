<?php // Runs before updating
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Link;
use Illuminate\Support\Facades\Cookie;

$minPhpVersion = '8.2.0';

set_time_limit(0);

if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    session(['update_error' => "This update requires at least PHP version $minPhpVersion. Your current PHP version is " . PHP_VERSION]);
    echo "<meta http-equiv='refresh' content='0;" . url()->current() . "/?error' />";
} else {
    /**
     * Generate Update Security Key
     */
    function generateUpdateSecurityKey(): array
    {
        $canUpdateFile = base_path('backups/CANUPDATE');

        // Verify CANUPDATE file exists (should already be there)
        if (!file_exists($canUpdateFile)) {
            throw new \Exception('CANUPDATE file does not exist');
        }

        // Generate cryptographically secure random key
        $key = bin2hex(random_bytes(32)); // 64 character hex string

        // Create timestamp for expiration validation
        $timestamp = time();

        // Encode key with timestamp (pipe-separated for easy parsing)
        $encodedKey = $key . '|' . $timestamp . '|' . bin2hex(random_bytes(16));

        // Store in .env file
        if (!EnvEditor::keyExists('UPDATE_SECURITY_KEY')) {
            EnvEditor::addKey('UPDATE_SECURITY_KEY', $encodedKey);
        } else {
            EnvEditor::setKey('UPDATE_SECURITY_KEY', $encodedKey);
        }

        return [
            'key' => $key,
            'timestamp' => $timestamp,
            'encoded_key' => $encodedKey,
            'expires_in' => 60,
        ];
    }

    /**
     * Get the stored security key with timestamp from .env
     *
     * @return array|null ['key' => string, 'timestamp' => int, 'nonce' => string] or null
     */
    function getStoredSecurityKey(): ?array
    {
        $encodedKey = env('UPDATE_SECURITY_KEY');

        if (!$encodedKey) {
            return null;
        }

        // Parse encoded key:  key|timestamp|nonce
        $parts = explode('|', $encodedKey);

        if (count($parts) !== 3) {
            return null;
        }

        return [
            'key' => $parts[0],
            'timestamp' => (int) $parts[1],
            'nonce' => $parts[2],
        ];
    }

    /**
     * Validate if the stored key is still valid (within 60 seconds)
     *
     * @return bool
     */
    function isStoredKeyValid(): bool
    {
        $keyData = getStoredSecurityKey();

        if (!$keyData) {
            return false;
        }

        // Check if key is older than 60 seconds
        $expiresAt = $keyData['timestamp'] + 60;

        return time() <= $expiresAt;
    }

    /**
     * Set the security key in cookie (call this after generating)
     * Survives session failures during updates
     *
     * @param string $key The generated key
     */
    function setUpdateSecurityKeyInCookie(string $key): void
    {
        // Set cookie for 2 minutes (120 seconds) - gives buffer beyond 60 second validation
        // HttpOnly = true:  Prevents JavaScript access (XSS protection)
        // Secure = false: Works on HTTP and HTTPS (change to true for production HTTPS only)
        // SameSite = 'Strict':  CSRF protection

        Cookie::queue(
            Cookie::make(
                'update_security_key',
                $key,
                2, // minutes
                '/',
                null,
                false, // secure - set to true if HTTPS only
                true, // httpOnly
                false,
                'strict', // sameSite
            ),
        );
    }

    try {
        if (!isset($preUpdateServer)) {
            $preUpdateServer = 'https://pre-update.linkstack.org/';
        }
        $file = Http::timeout(10)
            ->get($preUpdateServer . 'update')
            ->body();
        file_put_contents(base_path('resources/views/update.blade.php'), $file);
    } catch (Exception $e) {
    }

    if (trim(file_get_contents(base_path('version.json'))) < '4.0.0') {
        try {
            $file = base_path('storage/RSTAC');
            if (!file_exists($file)) {
                $handleFile = fopen($file, 'w');
                fclose($handleFile);
            }
        } catch (Exception $e) {
        }
    }

    if (trim(file_get_contents(base_path('version.json'))) < '4.8.1') {
        if (!Schema::hasColumn('links', 'type')) {
            Schema::table('links', function (Blueprint $table) {
                $table->string('type')->nullable();
            });
        }

        if (!Schema::hasColumn('links', 'type_params')) {
            Schema::table('links', function (Blueprint $table) {
                $table->text('type_params')->nullable();
            });
        }

        $links = Link::all();

        foreach ($links as $link) {
            $type = null;
            $params = false;

            switch ($link->button_id) {
                case '1':
                    $type = 'link';
                    break;
                case '2':
                    $type = 'link';
                    break;
                case '43':
                    $type = 'spacer';
                    $params = true;
                    break;
                case '42':
                    $type = 'heading';
                    $params = true;
                    break;
                case '93':
                    $type = 'text';
                    $params = true;
                    break;
                case '44':
                    $type = 'telephone';
                    break;
                case '6':
                    $type = 'email';
                    break;
                case '96':
                    $type = 'vcard';
                    break;
            }

            if ($type !== null) {
                $link->type = $type;
                if ($params === true) {
                    $link->type_params = json_encode(['custom_html' => true]);
                }
                $link->save();
            }
        }
    }
}
