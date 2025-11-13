<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'contact_number' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'city' => $request->city,
            'contact_number' => $request->contact_number,
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');

    }

}
