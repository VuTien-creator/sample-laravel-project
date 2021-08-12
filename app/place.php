<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class place extends Model
{
    protected $table= 'places';
    public $timestamps = false;
    protected $guarded = [];

    public function area(){
        return $this->belongsTo(area::class,'area_id');
    }

    public function session()
    {
        return $this->hasMany(session::class,'place_id');
    }
}
