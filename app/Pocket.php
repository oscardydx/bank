<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pocket extends Model
{	
	protected $table="pockets";
    protected $fillable = [
        'id', 'user_id', 'available_money','name','state',
    ];
}
