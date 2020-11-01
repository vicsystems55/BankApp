<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    
    protected $guarded=[];
    
    protected $table = 'blogs';
    //

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}
