<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'areas';

    public $timestamps = false;


    public function users()
    {
        return $this->hasMany('App\User');
    }
}
