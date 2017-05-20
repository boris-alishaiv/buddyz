<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuddyCard extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'buddy_cards';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
