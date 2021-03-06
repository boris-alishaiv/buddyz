<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMedal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_medals';

    public function medal()
    {
        return $this->belongsTo('App\Medal', 'medal_id');
    }

}
