<?php

namespace App\Http\Controllers\Api;

use App\Models\Wallet;
use App\Models\Deposit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepositController extends Controller
{

    private function rules() {
        return [
            'account_number' => 'required',
            'amount'    =>  'required',
        ];
    }

    public function deposit(Request $request) {
        $request->validate($this->rules());

        $accountNumber = $request->account_number;
        $amount = $request->amount;

        $wallet = Wallet::where('account_number', $accountNumber)->first();

        if(empty($wallet)) {
            return response()->json([
                'status' => 404,
                'message' => 'Account not found',
            ]);
        }

        if($amount <= 0) {
            return response()->json([
                'status' => 404,
                'message' => 'Invalid amount',
            ]);
        }

        $oldBalance = $wallet->balance;
        $newBalance = $oldBalance + $amount;

        Wallet::where('account_number', $accountNumber)->update([
            'balance' => $newBalance
        ]);

        $deposit = Deposit::create([
            'user_id' => $wallet->user_id,
            'wallet_id' => $wallet->id,
            'order_id' => Str::uuid(),
            'amount' => $newBalance
        ]);

        $data = Deposit::where('id', $deposit->id)->pluck('order_id', 'amount', 'status', 'created_at');

        return response()->json([
            'status' => 200,
            'message' => 'Deposit success',
            'data' => $data
        ]);

    }
}
