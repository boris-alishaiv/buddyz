<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function getUser()
    {
        return $this->belongsTo('App\User', 'get_user_id');
    }

    public function postUser()
    {
        return $this->belongsTo('App\User', 'post_user_id');
    }

}
