<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    public $table = 'wallet_transactions';

    public $fillable = [
        'user_id',
        'type',
        'amount',
        'opening_balance',
        'closing_balance',
        'remarks'
    ];

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'type' => 'string',
        'amount' => 'string',
        'opening_balance' => 'decimal:2',
        'closing_balance' => 'datetime',
        'remarks' => 'datetime'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'type' => 'nullable',
        'amount' => 'required',
        'opening_balance' => 'required',
        'closing_balance' => 'required',
        'remarks' => 'required'
    ];

    
}
