<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch the application language
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switch(Request $request)
    {
        $locale = $request->input('locale');
        
        // Validate locale
        $availableLocales = ['en', 'rw', 'sw', 'fr'];
        
        if (in_array($locale, $availableLocales)) {
            // Store in session
            Session::put('locale', $locale);
            
            // Set application locale
            App::setLocale($locale);
            
            return response()->json([
                'success' => true,
                'locale' => $locale,
                'message' => 'Language changed successfully'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Invalid language selected'
        ], 400);
    }
    
    /**
     * Get current locale
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function current()
    {
        return response()->json([
            'locale' => App::getLocale(),
            'available' => [
                'en' => 'English',
                'rw' => 'Kinyarwanda',
                'sw' => 'Kiswahili',
                'fr' => 'Français'
            ]
        ]);
    }
}
