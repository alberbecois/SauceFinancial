<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id_from',
        'user_id_to',
        'transaction_id_withdrawal',
        'transaction_id_deposit',
        'status',
        'amount'
    ];

}
