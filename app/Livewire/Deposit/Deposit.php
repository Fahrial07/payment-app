<?php

namespace App\Livewire\Deposit;

use App\Models\Wallet;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Deposit extends Component
{
    public $amount;

    public function deposit()
    {
        $this->validate([
            'amount' => 'required'
        ]);

   
        if($this->amount <= 0) {
            session()->flash('error', 'Jumlah deposit harus lebih dari 0.');
            return redirect()->route('deposit.index');
        }

        $wallet = Wallet::where('user_id', Auth::user()->id)->first();

        if($wallet) {

            $wallet->balance += $this->amount;
            $wallet->save();

            session()->flash('success', 'Deposit berhasil di lakukan.');
            return redirect()->route('deposit.index');

        } else {
            session()->flash('error', 'Jumlah deposit harus lebih dari 0.');
            return redirect()->route('deposit.index');
        }
        
    }

    public function render()
    {

        $wallet = Wallet::where('user_id', Auth::user()->id)->first();

        $data = [
            'wallet' => $wallet
        ];

        return view('livewire.deposit.deposit', $data);
    }
}
