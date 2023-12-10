<?php

namespace App\Http\Controllers;

use App\Models\Signatures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignaturesController extends Controller
{
    public function create()
    {
        // Ambil informasi tanda tangan jika sudah ada
        // $tandaTangan = Signatures::first();
        $user = Auth::user();

        // Check if the user already has a signature
        $tandaTangan = Signatures::where('id_user', $user->id_user)->first();

        return view('dashboard.signatures.create', compact('tandaTangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanda_tangan' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        $path = $request->file('tanda_tangan')->store('public/tanda_tangan');
        $fileName = str_replace('public/', '', $path);

        $tandaTangan = Signatures::updateOrCreate(
            ['id_user' => $user->id_user],
            ['path' => $fileName]
        );

        return redirect()->route('tanda_tangan.create')->with('success', 'Tanda tangan berhasil diunggah.');
    }

    public function edit()
    {
        $user = Auth::user();
        $tandaTangan = Signatures::where('id_user', $user->id_user)->first();

        return view('dashboard.signatures.edit', compact('tandaTangan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'tanda_tangan' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        $path = $request->file('tanda_tangan')->store('public/tanda_tangan');
        $fileName = str_replace('public/', '', $path);

        Signatures::updateOrCreate(
            ['id_user' => $user->id_user],
            ['path' => $path]
        );

        return redirect()->route('tanda_tangan.create')->with('success', 'Tanda tangan berhasil diperbarui.');
    }
}
