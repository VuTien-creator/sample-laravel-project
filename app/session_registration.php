<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class session_registration extends Model
{
    protected $table= 'session_registrations';
    public $timestamps = false;
    protected $guarded = [];
}
