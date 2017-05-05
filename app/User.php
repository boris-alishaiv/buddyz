<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // many to many
    public function activities()
    {
        return $this->belongsToMany('App\Activity');
    }

    // many to many
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    // many to many
    public function medals()
    {
        return $this->belongsToMany('App\Medal');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function jobRequire()
    {
        return $this->hasMany('App\JobRequire');
    }

    public function media()
    {
        return $this->hasMany('App\Media');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function vouches()
    {
        return $this->hasMany('App\Vouch');
    }



}
