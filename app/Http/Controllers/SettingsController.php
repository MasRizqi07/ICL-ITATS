<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function account()
    {
        $user = Auth::user();
        return view('pages.settings.account', compact('user'));
    }

    public function privacy()
    {
        $user = Auth::user();
        return view('pages.settings.privacy', compact('user'));
    }
}
