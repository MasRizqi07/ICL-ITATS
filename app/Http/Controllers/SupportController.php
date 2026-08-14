<?php

namespace App\Http\Controllers;

class SupportController extends Controller
{
    public function help()
    {
        return view('pages.help.index');
    }

    public function contact()
    {
        return view('pages.support.contact');
    }

    public function about()
    {
        return view('pages.about.index');
    }

    public function flow()
    {
        return view('pages.flow.overview');
    }
}
