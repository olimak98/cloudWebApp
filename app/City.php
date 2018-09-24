<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'providence_id'
    ];

    public function providence()
    {
        return $this->belongsTo('App\Providence');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
