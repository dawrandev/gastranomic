<?php

namespace App\Http\Controllers;

use App\Helpers\LanguageHelper;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $langCode = $request->input('lang');

        // Validate language code exists
        $exists = Language::where('code', $langCode)->exists();

        if ($exists) {
            LanguageHelper::setCurrentLang($langCode);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
