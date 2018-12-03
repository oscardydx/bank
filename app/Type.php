<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{	
	protected $table="types";
    protected $fillable = [
        'id', 'name',
    ];
    public function transaction()
    {
        return $this->hasOne('App\Transaction');
    }
    
}
