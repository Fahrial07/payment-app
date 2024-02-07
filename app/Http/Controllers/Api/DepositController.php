<?php

namespace App\Http\Controllers\Api;

use App\Models\Wallet;
use App\Models\Deposit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepositController extends Controller
{

    function base64_decode($data) {
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    private function rules() {
        return [
            'account_number' => 'required',
            'amount'    =>  'required',
        ];
    }

    

    public function deposit(Request $request) {

        //Base64 Token
        // QWxpIEZhaHJpYWwgQW53YXI=
        //Ali Fahrial Anwar
        $token = $request->bearerToken();

        if(empty($token)) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ]);
        }

        $decodeToken = $this->base64_decode($token);

        if($decodeToken != 'Ali Fahrial Anwar') {
            return response()->json([
                'status' =>  400,
                'message' => 'Invalid Credentials',
            ]);
        }

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
            'amount' => $amount
        ]);

        $data = Deposit::where('id', $deposit->id)->first();

        return response()->json([
            'status' => 200,
            'message' => 'Deposit success',
            'data' => $data
        ]);

    }
}
