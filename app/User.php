<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'company_id',
        'city_id',
        'email', 
        'first_name',
        'last_name',
        'email_verified_at',
        'password',
        'phone',
        'verified',
        'confirmation_code',
        'confirmed'
    ];

    protected $hidden = [
        'password', 'remember_token',
        'confirmation_code'
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function databases()
    {
        return $this->hasMany('App\Database');
    }

    public function applications()
    {
        return $this->hasMany('App\Application');
    }

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
