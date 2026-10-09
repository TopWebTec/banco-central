<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankingNode extends Model
{
    use HasFactory;

    protected $table = 'banking_nodes';
    public $timestamps = false; // Supabase gestiona created_at por defecto

    // Indispensable: Supabase maneja UUIDs en lugar de enteros autoincrementales
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

    protected $casts = [
        'cash_balance' => 'decimal:2',
    ];
}