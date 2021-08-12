<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table= 'organizers';
    public $timestamps = false;
    protected $guarded = [];
    protected $rememberTokenName= false;


    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function campaign(){
        return $this->hasMany(campaign::class,'organizer_id');
    }
}