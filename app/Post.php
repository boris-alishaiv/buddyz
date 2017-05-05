<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function media()
    {
        return $this->hasMany('App\Media');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
