<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    public $table = 'withdrawals';

    protected $guarded = ['id'];

    public function wallet() {
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
