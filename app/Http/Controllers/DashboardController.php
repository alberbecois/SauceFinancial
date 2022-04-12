<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        $transactions = auth()->user()->transactions;

        return view('dashboard', [
            'transactions' => $transactions
        ]);
    }
}
