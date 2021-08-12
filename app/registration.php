<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class registration extends Model
{
    protected $table= 'registrations';
    public $timestamps = false;
    protected $guarded = [];
    public function session_registration(){
        return $this->hasMany(session_registration::class,'registration_id');
    }

    public function ticket(){
        return $this->belongsTo(campaign_ticket::class,'ticket_id');
    }
}
