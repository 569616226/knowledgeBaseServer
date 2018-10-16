<?php

namespace App\Containers\Topic\Models;

use App\Containers\Appoint\Models\Appoint;
use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status',
        'title',
        'describe',
        'price',
        'ser_time',
        'ser_type',
        'need_infos',
        'remark',
        'guest_id'
    ];

    protected $attributes = [

    ];

    protected $hidden = [
        'guest_id'
    ];

    protected $casts = [
        'need_infos' => 'array'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'topics';

    public function appoints()
    {
        return $this->hasMany(Appoint::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
