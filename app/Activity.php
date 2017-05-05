<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activities';

    // many to many
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function category()
    {
        return $this->hasOne('App\Category');
    }

    public function media()
    {
        return $this->hasMany('App\Media');
    }
}
