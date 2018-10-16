<?php

namespace App\Containers\AppointAppraise\Models;

use App\Containers\Appoint\Models\Appoint;
use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Models\Model;

class AppointAppraise extends Model
{
    protected $fillable = [
        'star',
        'degree',
        'content',
        'appoint_id',
        'guest_id'
    ];

    protected $attributes = [

    ];

    protected $hidden = [
        'appoint_id',
        'guest_id'
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
    protected $resourceKey = 'appoint_appraises';

    /*约见*/
    public function appoint()
    {
        return $this->belongsTo(Appoint::class);
    }

    /*评价人*/
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
