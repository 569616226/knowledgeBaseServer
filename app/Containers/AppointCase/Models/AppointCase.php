<?php

namespace App\Containers\AppointCase\Models;

use App\Containers\Appoint\Models\Appoint;
use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointCase extends Model
{

    use SoftDeletes;

    protected $fillable = [

        'location',
        'appoint_time',
        'guest_id',
        'appoint_id',
    ];

    protected $attributes = [

    ];

    protected $hidden = [
        'guest_id',
        'appoint_id',
    ];

    protected $casts = [

    ];

    protected $dates = [
        'appoint_time',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'appoint_cases';

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function appoint()
    {
        return $this->belongsTo(Appoint::class);
    }
}
