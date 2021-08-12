<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class citizen extends Model
{
    protected $table= 'citizens';
    public $timestamps = false;
    protected $guarded = [];

    public function registration(){
        return $this->hasMany(registration::class,'citizen_id');
    }
    public function session_registration(){
        return $this->hasManyThrough(session_registration::class,registration::class,'citizen_id','registration_id');
    }
}
