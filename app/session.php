<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    protected $table= 'sessions';
    public $timestamps = false;
    protected $guarded = [];

    public function place(){
        return $this->belongsTo(place::class,'place_id');
    }
    public function session_registration(){
        return $this->hasMany(session_registration::class,'session_id');
    }
}
