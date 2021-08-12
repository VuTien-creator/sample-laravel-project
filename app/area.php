<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    protected $table= 'areas';
    public $timestamps = false;
    protected $guarded = [];

    public function session()
    {
        return $this->hasManyThrough(session::class,place::class,'area_id','place_id');
    }
    public function place()
    {
        return $this->hasMany(place::class,'area_id');
    }

    public function campaign()
    {
        return $this->belongsTo(campaign::class,'campaign_id');
    }
}
