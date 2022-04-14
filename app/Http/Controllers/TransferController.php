<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransferController extends Controller
{
    function createWithdrawal($user_id_from, $amount, $user_email_to)
    {
        $description = 'TRANSFER TO '.$user_email_to;

        $transaction = Transaction::create([
            'user_id' => $user_id_from,
            'type' => 'withdrawal',
            'amount' => $amount,
            'description' => $description
        ]);

        return $transaction->id;
    }

    function createDeposit($user_id_from, $amount, $recipient_id)
    {
        $sender = User::find($user_id_from);
        $description = 'TRANSFER FROM '.$sender->email;

        $transaction = Transaction::create([
            'user_id' => $recipient_id,
            'type' => 'deposit',
            'amount' => $amount,
            'description' => $description
        ]);

        return $transaction->id;
    }

    function verifyRequest($transferID, $userID)
    {
        try {
            $transfer = Transfer::where('id', $transferID)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            // If not found redirect back to the dashboard with an error
            return back()->with("invalidrequest", "Action cancelled.");
        }

        if ($transfer->user_id_from = $userID || $transfer->user_id_to = $userID) {
            return $transfer;
        } else {
            return back()->with("invalidrequest", "Action cancelled.");
        }
    }

    function create(Request $request)
    {
        // Find the recipient user
        try {
            $recipient = User::where('email', request()->destemail)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            // If not found redirect back to the dashboard with an error
            return back()->with("trsferror", "Recipient not found. Transfer has been cancelled.");
        }

        // Create a negative integer from amount provided in the request
        $amount_to_transfer = floatval('-'.trim($request->trsfamount));

        // After successful validation create a withdrawal transaction
        $transactionid = $this->createWithdrawal(auth()->user()->id, $amount_to_transfer, $recipient->email);

        // Create a pending transfer
        Transfer::create([
            'user_id_from' => auth()->user()->id,
            'user_id_to' => $recipient->id,
            'transaction_id_withdrawal' => $transactionid,
            'transaction_id_deposit' => null,
            'status' => 'pending',
            'amount' => abs($amount_to_transfer)
        ]);

        // Redirect back to dashboard with a success message
        return back()->with("trsfsuccess", "Your transfer was successfully initiated. Please be advised that you may cancel at any time before your transfer is accepted.");
    }

    function update(Request $request)
    {
        // Determining the action based on the request
        switch ($request->input('action')) {
            case 'accept':
                $transfer = $this->verifyRequest($request->transferID, auth()->user()->id);
                $transfer->status = "accepted";
                $transfer->transaction_id_deposit = $this->createDeposit($transfer->user_id_from, $transfer->amount, auth()->user()->id);
                $transfer->save();
                return back()->with("accepted", "Transfer successfully deposited.");

            case 'decline':
                $transfer = $this->verifyRequest($request->transferID, auth()->user()->id);
                $transfer->status = "cancelled";
                $transfer->transaction_id_deposit = $this->createDeposit($transfer->user_id_from, $transfer->amount, auth()->user()->id);
                $transfer->save();
                return back()->with("cancelled", "Transfer successfully cancelled.");

            default:
                return back()->with('invalidrequest', 'Action cancelled.');

        }

        // Ensure user is authorized to perform action
        // Generate a deposit
        // Retrieve and modify transfer
        // Redirect to the dashboard with message
    }
}
