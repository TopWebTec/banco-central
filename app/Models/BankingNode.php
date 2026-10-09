<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankingNode extends Model
{
    use HasFactory;

    protected $table = 'banking_nodes';
    public $timestamps = false; // Supabase usa created_at por defecto

    protected $fillable = [
        'name',
        'type',
        'api_key_hash',
        'cash_balance',
        'manager_name',
        'status',
    ];
}