<?php

namespace App\Helpers;

class LanguageHelper
{
    public static function getCurrentLang(): string
    {
        return session('admin_lang', 'ru');
    }

    public static function setCurrentLang(string $langCode): void
    {
        session(['admin_lang' => $langCode]);
    }
}
