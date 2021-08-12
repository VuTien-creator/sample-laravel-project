<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class organizer extends Model
{
    protected $table= 'organizers';
    public $timestamps = false;
    protected $guarded = [];

    public function campaign(){
        return $this->hasMany(campaign::class,'organizer_id');
    }
}
