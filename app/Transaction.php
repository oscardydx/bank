<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
     protected $fillable = [
        'id', 'type', 'value','origin_user_id',
    ];
}
