<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;

class CheckTranslations extends Command
{
    protected $signature = 'translation-check {language}';
    protected $description = 'Check if translation files are up to date';

    public function handle()
    {
        $defaultLanguage = 'en';
        $languageCode = $this->argument('language');
        $defaultTranslations = include base_path("resources/lang/{$defaultLanguage}/messages.php");
        $translations = include base_path("resources/lang/{$languageCode}/messages.php");

        $missingKeys = $this->getMissingKeys($defaultTranslations, $translations);

        if (count($missingKeys) > 0) {
            $this->output->error("{$languageCode} translation file is out of date!");
            $this->output->table(['Missing Keys'], $missingKeys);
            $this->output->error('Number of missing keys: ' . count($missingKeys));
        } else {
            $this->output->success("{$languageCode} translation file is up to date!");
        }
    }

    protected function getMissingKeys(array $default, array $translations)
    {
        $missingKeys = [];

        foreach (Arr::dot($default) as $key => $value) {
            if (!Arr::has($translations, $key)) {
                $missingKeys[] = [$key];
            }
        }

        return $missingKeys;
    }
}
