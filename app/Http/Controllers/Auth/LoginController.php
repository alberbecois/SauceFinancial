<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // Validate form input
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log-in the user with provided credentials
        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Email or password incorrect');
        };

        // Redirect to Dashboard
        return redirect()->route('dashboard');
    }
}
