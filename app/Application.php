<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'repository',
        'branch',
        'status',
        'started_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function database()
    {
        return $this->belongsTo('App\Database');
    }
}
