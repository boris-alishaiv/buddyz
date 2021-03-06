<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function jobReuire()
    {
        return $this->hasMany('App\BuddyCard');
    }

    // many to many
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
