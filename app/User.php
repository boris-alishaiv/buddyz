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
        'first_name', 'last_name', 'phone', 'date_of_birth',
        'gender', 'address', 'city', 'address', 'email', 'password',
        'account_type', 'sns_acc_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function userActivities()
    {
        return $this->hasMany('App\UserActivity');
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

    public function buddyCards()
    {
        return $this->hasMany('App\BuddyCard');
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
