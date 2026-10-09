<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'origin_account_id',
        'destination_account_id',
        'node_id',
        'amount',
        'type',
        'created_at',
    ];
}