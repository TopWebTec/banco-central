<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankingNode extends Model
{
    protected $table = 'banking_nodes';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'type',
        'api_key_hash',
        'cash_balance',
        'manager_name',
        'status',
        'created_at',
    ];
}