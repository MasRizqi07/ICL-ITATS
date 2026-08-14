<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Competency;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function careers()
    {
        $careers = Career::withCount('competencies')->get();
        return view('pages.admin.careers', compact('careers'));
    }

    public function storeCareer(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string',
        ]);

        Career::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'status' => $validated['status'],
            'version' => 1,
        ]);

        return redirect()->route('admin.careers')->with('success', 'Profil karier baru berhasil ditambahkan.');
    }

    public function competencies()
    {
        $competencies = Competency::withCount('careers')->get();
        return view('pages.admin.competencies', compact('competencies'));
    }

    public function storeCompetency(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string',
            'description' => 'required|string',
        ]);

        Competency::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'domain' => $validated['domain'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('admin.competencies')->with('success', 'Kompetensi kurikulum baru berhasil ditambahkan.');
    }
}
