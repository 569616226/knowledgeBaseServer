<?php

namespace App\Containers\Nav\Models;

use App\Containers\Guest\Models\Guest;
use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;

class Nav extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'pid',
        'user_id',
    ];

    protected $attributes = [

    ];

    protected $hidden = [
        'user_id'
    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'navs';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getChildrenAttribute()
    {
        return Nav::where('pid', $this->id)->get();
    }

    public function guests()
    {
        return $this->belongsToMany(Guest::class);
    }

}
