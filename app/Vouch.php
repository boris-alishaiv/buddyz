<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vouch extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vouches';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
