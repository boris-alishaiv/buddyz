<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medals';

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
