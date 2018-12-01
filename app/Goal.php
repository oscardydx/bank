<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'id', 'user_id', 'available_money','name','state','money_goal','final_date',
    ];
}
