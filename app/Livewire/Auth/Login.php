<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Component
{
    public $email, $password;

    public function login() {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $this->email)->first();

        if(empty($user)) {
            session()->flash('error', 'Alamat Email atau Password Anda salah!.');
            return redirect()->route('login');
        } else {

            if (Hash::check($this->password, $user->password)) {

                if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                    Auth::loginUsingId($user->id);
                    return redirect('/');
                } else {
                    session()->flash('error', 'Alamat Email atau Password Anda salah!.');
                    return redirect()->route('login');
                }

            } else {
                session()->flash('error', 'Alamat Email atau Password Anda salah!.');
                return redirect()->route('login');
            }
        }

    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
