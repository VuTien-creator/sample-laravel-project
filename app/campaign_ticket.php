<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class campaign_ticket extends Model
{
    protected $table= 'campaign_tickets';
    public $timestamps = false;
    protected $guarded = [];

    public function special()
    {
        $temp = json_decode($this->special_validity,true);

        $this->available = true;
        if($temp['type']=='date'){
            // dd(1);
            $this->description = 'Available until '.date('F j, Y',strtotime($temp['date']));

            if($temp['date']<='2021-07-01'){
                $this->available = false;
            }
        }elseif($temp['type']=='amount'){
            // dd(2);
            $this->description = $temp['amount'].' tickets available';

            if((Int)$temp['amount']<=(Int)$this->registration->count()){
                $this->available = false;
            }
        }
    }

    public function registration(){
        return $this->hasMany(registration::class,'ticket_id');
    }

    public function campaign(){
        return $this->belongsTo(campaign::class,'campaign_id');
    }
}
