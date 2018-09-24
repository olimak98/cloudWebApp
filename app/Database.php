<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function applications()
    {
        return $this->hasMany('App\Application');
    }
}
