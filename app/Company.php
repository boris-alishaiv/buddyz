<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    public function media()
    {
        return $this->hasMany('App\Media');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }


}
