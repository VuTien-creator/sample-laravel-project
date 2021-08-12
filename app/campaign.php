<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class campaign extends Model
{
    protected $table= 'campaigns';
    public $timestamps = false;
    protected $guarded = [];

    public function registration()
    {
        return $this->hasManyThrough(registration::class,campaign_ticket::class,'campaign_id','ticket_id');
    }
    public function organizer()
    {
        return $this->belongsTo(organizer::class,'organizer_id');
    }
    public function ticket()
    {
        return $this->hasMany(campaign_ticket::class,'campaign_id');
    }
    public function area()
    {
        return $this->hasMany(area::class,'campaign_id');
    }
    public function place()
    {
        return $this->hasManyThrough(place::class,area::class,'campaign_id','area_id');
    }
}

