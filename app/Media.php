<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media';

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
