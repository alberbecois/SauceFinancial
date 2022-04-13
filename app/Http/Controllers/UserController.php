<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function update(Request $request)
    {
        $userToUpdate = User::find(auth()->user()->id);
        $userToUpdate->address = $request->newaddress;
        $userToUpdate->city = $request->newcity;
        $userToUpdate->province = $request->newprovince;
        $userToUpdate->postalcode = $request->newpostalcode;
        $userToUpdate->phonenum = $request->newphonenum;
        $userToUpdate->email = $request->newemail;

        $userToUpdate->save();

        return back()->with('success', 'Profile updated successfully');
    }
}
