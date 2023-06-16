<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Throwable;

interface TokenProviderInterface
{

    public function generateToken(string $source, string $target, string $text): string;
}

class GoogleTokenGenerator implements TokenProviderInterface
{

    public function generateToken(string $source, string $target, string $text): string
    {
        $tkk = ['406398', 2087938574];

        for ($d = [], $e = 0, $f = 0; $f < $this->length($text); $f++) {
            $g = $this->charCodeAt($text, $f);
            if ($g < 128) {
                $d[$e++] = $g;
            } else {
                if ($g < 2048) {
                    $d[$e++] = $g >> 6 | 192;
                } else {
                    if ($g & 64512 === 55296 && $f + 1 < $this->length($text) && ($this->charCodeAt($text, $f + 1) & 64512) === 56320) {
                        $g = 65536 + (($g & 1023) << 10) + ($this->charCodeAt($text, ++$f) & 1023);
                        $d[$e++] = $g >> 18 | 240;
                        $d[$e++] = $g >> 12 & 63 | 128;
                    } else {
                        $d[$e++] = $g >> 12 | 224;
                    }
                    $d[$e++] = $g >> 6 & 63 | 128;
                }
                $d[$e++] = $g & 63 | 128;
            }
        }

        $a = $tkk[0];
        foreach ($d as $value) {
            $a += $value;
            $a = $this->rl($a, '+-a^+6');
        }
        $a = $this->rl($a, '+-3^+b+-f');
        $a ^= $tkk[1];
        if ($a < 0) {
            $a = ($a & 2147483647) + 2147483648;
        }
        $a = fmod($a, 1000000);

        return $a . '.' . ($a ^ $tkk[0]);
    }

    private function rl(int $a, string $b): int
    {
        for ($c = 0; $c < strlen($b) - 2; $c += 3) {
            $d = $b[$c + 2];
            $d = $d >= 'a' ? ord($d[0]) - 87 : (int) $d;
            $d = $b[$c + 1] === '+' ? $this->unsignedRightShift($a, $d) : $a << $d;
            $a = $b[$c] === '+' ? ($a + $d & 4294967295) : $a ^ $d;
        }

        return $a;
    }

    private function unsignedRightShift(int $a, int $b): int
    {
        if ($b >= 32 || $b < -32) {
            $m = (int) ($b / 32);
            $b -= ($m * 32);
        }

        if ($b < 0) {
            $b += 32;
        }

        if ($b === 0) {
            return (($a >> 1) & 0x7fffffff) * 2 + (($a >> $b) & 1);
        }

        if ($a < 0) {
            $a >>= 1;
            $a &= 2147483647;
            $a |= 0x40000000;
            $a >>= ($b - 1);
        } else {
            $a >>= $b;
        }

        return $a;
    }

    private function charCodeAt(string $string, int $index): int
    {
        return mb_ord(mb_substr($string, $index, 1));
    }

    private function length(string $string): int
    {
        return mb_strlen($string);
    }
}

class GoogleTranslate
{

    protected Client $client;

    protected ?string $source;

    protected ?string $target;

    protected ?string $lastDetectedSource;

    protected string $url = 'https://translate.google.com/translate_a/single';

    protected array $options = [];

    protected array $urlParams = [
        'client'   => 'gtx',
        'hl'       => 'en',
        'dt'       => [
            't',   
            'bd',  
            'at',  
            'ex',  
            'ld',  
            'md',  
            'qca', 
            'rw',  
            'rm',  
            'ss'   
        ],
        'sl'       => null, 
        'tl'       => null, 
        'q'        => null, 
        'ie'       => 'UTF-8', 
        'oe'       => 'UTF-8', 
        'multires' => 1,
        'otf'      => 0,
        'pc'       => 1,
        'trs'      => 1,
        'ssel'     => 0,
        'tsel'     => 0,
        'kc'       => 1,
        'tk'       => null,
    ];

    protected array $resultRegexes = [
        '/,+/'  => ',',
        '/\[,/' => '[',
    ];

    protected TokenProviderInterface $tokenProvider;

    public function __construct(string $target = 'en', string $source = null, array $options = [], TokenProviderInterface $tokenProvider = null)
    {
        $this->client = new Client();
        $this->setTokenProvider($tokenProvider ?? new GoogleTokenGenerator)
            ->setOptions($options) 
            ->setSource($source)
            ->setTarget($target);
    }

    public function setTarget(string $target): self
    {
        $this->target = $target;
        return $this;
    }

    public function setSource(string $source = null): self
    {
        $this->source = $source ?? 'auto';
        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function setClient(string $client): self
    {
        $this->urlParams['client'] = $client;
        return $this;
    }

    public function setOptions(array $options = []): self
    {
        $this->options = $options;
        return $this;
    }

    public function setTokenProvider(TokenProviderInterface $tokenProvider): self
    {
        $this->tokenProvider = $tokenProvider;
        return $this;
    }

    public function getLastDetectedSource(): ?string
    {
        return $this->lastDetectedSource;
    }

    public static function trans(string $string, string $target = 'en', string $source = null, array $options = [], TokenProviderInterface $tokenProvider = null): ?string
    {
        return (new self)
            ->setTokenProvider($tokenProvider ?? new GoogleTokenGenerator)
            ->setOptions($options) 
            ->setSource($source)
            ->setTarget($target)
            ->translate($string);
    }

    public function translate(string $string): ?string
    {

        if ($this->source === $this->target) {
            return $string;
        }

        $responseArray = $this->getResponse($string);

        if (empty($responseArray[0])) {
            return null;
        }

        $detectedLanguages = [];

        foreach ($responseArray as $item) {
            if (is_string($item)) {
                $detectedLanguages[] = $item;
            }
        }

        if (isset($responseArray[count($responseArray) - 2][0][0])) {
            $detectedLanguages[] = $responseArray[count($responseArray) - 2][0][0];
        }

        $this->lastDetectedSource = null;

        foreach ($detectedLanguages as $lang) {
            if ($this->isValidLocale($lang)) {
                $this->lastDetectedSource = $lang;
                break;
            }
        }

        if (is_string($responseArray)) {
            return $responseArray;
        }

        if (is_array($responseArray[0])) {
            return (string) array_reduce($responseArray[0], static function ($carry, $item) {
                $carry .= $item[0];
                return $carry;
            });
        }

        return (string) $responseArray[0];
    }

    public function getResponse(string $string): array
    {
        $queryArray = array_merge($this->urlParams, [
            'sl'   => $this->source,
            'tl'   => $this->target,
            'tk'   => $this->tokenProvider->generateToken($this->source, $this->target, $string),
            'q'    => $string
        ]);

        $queryUrl = preg_replace('/%5B\d+%5D=/', '=', http_build_query($queryArray));

        try {
            $response = $this->client->get($this->url, [
                    'query' => $queryUrl,
                ] + $this->options);
        } catch (GuzzleException $e) {
            match ($e->getCode()) {
                429, 503 => throw new RateLimitException($e->getMessage(), $e->getCode()),
                413 => throw new LargeTextException($e->getMessage(), $e->getCode()),
                default => throw new TranslationRequestException($e->getMessage(), $e->getCode()),
            };
        } catch (Throwable $e) {
            throw new TranslationRequestException($e->getMessage(), $e->getCode());
        }

        $body = $response->getBody(); 

        $bodyJson = preg_replace(array_keys($this->resultRegexes), array_values($this->resultRegexes), $body);

        try {
            $bodyArray = json_decode($bodyJson, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            throw new TranslationDecodingException('Data cannot be decoded or it is deeper than the recursion limit');
        }

        return $bodyArray;
    }

    protected function isValidLocale(string $lang): bool
    {
        return (bool) preg_match('/^([a-z]{2,3})(-[A-Za-z]{2,4})?$/', $lang);
    }
}

class Translate extends Command
{
    protected $signature = 'translate';

    protected $description = 'Translate language files';

    public function handle()
    {
        $locales = config('app.supported_locales'); 
        $sourceLocale = 'en'; 

        foreach ($locales as $locale) {
            $langPath = resource_path("lang/{$locale}");
            if (!File::exists($langPath)) {
                File::makeDirectory($langPath, 0755, true);
            }
        }

        $sourceFile = resource_path("lang/{$sourceLocale}/messages.php");
        $sourceTranslations = require($sourceFile);

        foreach ($locales as $locale) {
            $targetFile = resource_path("lang/{$locale}/messages.php");
            $targetTranslations = File::exists($targetFile) ? require($targetFile) : [];

            $tr = new GoogleTranslate();
            $tr->setSource($sourceLocale);
            $tr->setTarget($locale);

            foreach ($sourceTranslations as $key => $value) {
                if (!array_key_exists($key, $targetTranslations)) {
                    $translatedValue = $tr->translate($value);
                    $targetTranslations[$key] = $translatedValue;
                }
            }

            $content = '<?php' . PHP_EOL . PHP_EOL;
            $content .= 'return ' . var_export($targetTranslations, true) . ';' . PHP_EOL;

            file_put_contents($targetFile, $content);

            $this->info("Translations for '{$locale}' created successfully.");
        }
    }
}