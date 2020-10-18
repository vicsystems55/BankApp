<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    //
    protected $guarded = []; 

    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
