<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerProfileController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Kirim data ke view
        return view('customer.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'contact_number' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
        ]);

        $user->update([
            'username' => $validated['name'],
            'email' => $validated['email'],
            'contact_number' => $validated['contact_number'] ?? null,
            'dob' => $validated['dob'] ?? null,
            'gender' => $validated['gender'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

}
