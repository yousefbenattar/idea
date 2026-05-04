<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    public function store()
    {
        $attrebuits = request()->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:3', 'max:255'],
        ]);
        if (Auth::attempt($attrebuits)) {
            request()->session()->regenerate();
            return redirect()->intended('/')->with('success', 'You are now logged in');
        } else {
            return back()->withErrors(['email' => '', 'password' => 'we we unable to login with the givining cridentials'])->withInput();
        }
    }
    public function destroy()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
