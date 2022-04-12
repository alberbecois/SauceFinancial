<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index()
    {
        $balance = DB::table('transactions')
                        ->where('user_id', '=', auth()->user()->id)
                        ->pluck('amount');
        $curBalance = $balance->sum();
        $transactions = auth()->user()->transactions;
        $recent = DB::table('transactions')
                        ->where('user_id', '=', auth()->user()->id)
                        ->latest()
                        ->limit(4)
                        ->get();

        return view('dashboard', [
            'transactions' => $transactions,
            'recent' => $recent,
            'balance' => $curBalance
        ]);
    }
}
