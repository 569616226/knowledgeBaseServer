<?php

namespace App\Containers\Advert\Models;

use App\Containers\User\Models\User;
use App\Ship\Parents\Models\Model;

class Advert extends Model
{
    protected $fillable = [
        'name',
        'path',
        'type',
        'order',
        'url',
        'user_id'
    ];

    protected $attributes = [

    ];

    protected $hidden = [
        'user_id',
        'type',
        'order',
    ];

    protected $casts = [
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'adverts';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
