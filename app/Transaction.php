<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'type', 'currency', 'user_id', 'owner_id', 'change_value',
        'amount', 'total_amount', 'rating', 'state',
    ];
}
