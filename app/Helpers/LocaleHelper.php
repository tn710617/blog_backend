<?php

namespace App\Helpers;

class LocaleHelper
{

    public function normalizeLocale(string $locale): string
    {
        return str_replace('-', '_', $locale);
    }

    public function getSupportedLocales(): array
    {
        return ['en', 'zh-TW'];
    }

}