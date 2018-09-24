<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Providence extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function cities()
    {
        return $this->hasMany('App\City');
    }
}
