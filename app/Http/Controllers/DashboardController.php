<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index()
    {
        // Get current account balance
        $balance = DB::table('transactions')
                        ->where('user_id', '=', auth()->user()->id)
                        ->pluck('amount');
        $curBalance = $balance->sum();

        // Get all user transactions
        $transactions = auth()->user()->transactions;

        // Get four most recent transactions
        $recent = DB::table('transactions')
                        ->where('user_id', '=', auth()->user()->id)
                        ->latest()
                        ->limit(4)
                        ->get();

        // Get outbound transfers
        $outbound = DB::table('transfers')
                        ->join('users as recipient', 'recipient.id', '=', 'transfers.user_id_to')
                        ->join('users as sender', 'sender.id', '=', 'transfers.user_id_from')
                        ->select('transfers.*', 'recipient.name as recipient_name', 'sender.name as sender_name')
                        ->where('status', '=', 'pending')
                        ->where('user_id_from', '=', auth()->user()->id)
                        ->get();

        // Get inbound transfers
        $inbound = DB::table('transfers')
                        ->join('users as recipient', 'recipient.id', '=', 'transfers.user_id_to')
                        ->join('users as sender', 'sender.id', '=', 'transfers.user_id_from')
                        ->select('transfers.*', 'recipient.name as recipient_name', 'sender.name as sender_name')
                        ->where('status', '=', 'pending')
                        ->where('user_id_to', '=', auth()->user()->id)
                        ->get();

        // Get previously completed transfers
        $completed = DB::table('transfers')
                        ->join('users as recipient', 'recipient.id', '=', 'transfers.user_id_to')
                        ->join('users as sender', 'sender.id', '=', 'transfers.user_id_from')
                        ->select('transfers.*', 'recipient.name as recipient_name', 'sender.name as sender_name')
                        ->whereNot('status', '=', 'pending')
                        ->where(function ($query) {
                            $query->where('user_id_from', '=', auth()->user()->id)
                                  ->orWhere('user_id_to', '=', auth()->user()->id);
                        })->get();

        return view('dashboard', [
            'transactions' => $transactions,
            'recent' => $recent,
            'balance' => $curBalance,
            'outbound' => $outbound,
            'inbound' => $inbound,
            'completed' => $completed
        ]);
    }
}
