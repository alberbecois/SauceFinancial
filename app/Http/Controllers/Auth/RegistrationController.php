<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validate form input
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'province' => 'required|max:255',
            'postalcode' => 'required|max:255',
            'phonenumber' => 'required|max:255'
        ]);

        // Upon successful validation add new User to the database

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'city' => $request->city,
                'province' => $request->province,
                'postalcode' => $request->postalcode,
                'phonenum' => $request->phonenumber,
            ]);
        } catch (QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                return back()->with("duplicateentry", "This email is already registered to a user.");
            }
        }

        // Log-in as the new User
        auth()->attempt($request->only('email', 'password'));

        // Redirect to the Dashboard
        return redirect()->route('dashboard');
    }
}
