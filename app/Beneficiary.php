<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{	
	protected $table="beneficiaries";
    protected $fillable = [
        'id', 'transaction_id', 'user_id',];

       public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function user(){
    	return $this->belongsTo('App\User');}
}
