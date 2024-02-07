<?php

namespace App\Livewire\Withdrawal;

use App\Models\Wallet;
use Livewire\Component;
use App\Models\Withdrawal as WithdrawalModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Withdrawal extends Component
{
    public $amount;
    public function withdrawal() {
        $this->validate([
            'amount' => 'required|numeric|min:1|max:' . Wallet::where('user_id', Auth::user()->id)->first()->balance
        ]);

        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        
        if($wallet->balance <= 0) {
            session()->flash('error', 'Opps.. Your balance is.. Balance is 0.00');
        }

        if(empty($wallet)) {
            session()->flash('error', 'Withdrawal failed');
            return redirect()->route('withdrawal.index');
        }

        
        $walletWithdrawal = Wallet::where('user_id', Auth::user()->id)->decrement('balance', $this->amount);

        if ($walletWithdrawal) {

            WithdrawalModel::create([
                'user_id' => Auth::user()->id,
                'wallet_id' => $wallet->id,
                'order_id' => Str::uuid(),
                'amount' => $this->amount,
                'status' => 1
            ]);

            $this->amount = '';
            session()->flash('success', 'Withdrawal successfully.');
            return redirect()->route('withdrawal.index');
        } else {
            session()->flash('error', 'Withdrawal failed');
            return redirect()->route('withdrawal.index');

        }

    }
    public function render()
    {
        $data = [
            'wallet' => Wallet::where('user_id', Auth::user()->id)->first()
        ];
        return view('livewire.withdrawal.withdrawal', $data);
    }
}
