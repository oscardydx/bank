<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{	
	protected $table="transactions";
     protected $fillable = [
        'id', 'type_id', 'value','origin_user_id',
    ];

    public function beneficiary()
    {
        return $this->hasOne('App\Beneficiary');
    }
    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
