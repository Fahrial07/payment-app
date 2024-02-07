<?php

namespace App\Livewire\Account;

use App\Models\Wallet;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Account extends Component
{
    public function render()
    {

        $account = Wallet::where('user_id', Auth::user()->id)->first();

        $data = [
            'wallet' => $account
        ];

        return view('livewire.account.account', $data);
    }
}
