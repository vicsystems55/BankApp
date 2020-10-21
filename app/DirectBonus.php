<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectBonus extends Model
{
    protected $guarded = [];  
    //
    public function users()
    {
        return $this->belongsTo('App\User', 'referral', 'referree');
    }
}
