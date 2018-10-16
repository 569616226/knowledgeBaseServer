<?php

namespace App\Containers\Finace\Models;

use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Models\Model;

class Finace extends Model
{
    protected $fillable = [
        'name',
        'order_name',
        'order_no',
        'price',
        'type',
        'guest_id',
    ];

    protected $attributes = [

    ];

    protected $hidden = [

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
    protected $resourceKey = 'finaces';

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
