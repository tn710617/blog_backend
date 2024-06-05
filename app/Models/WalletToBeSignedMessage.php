<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletToBeSignedMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_address',
        'to_be_signed_message'
    ];
}
