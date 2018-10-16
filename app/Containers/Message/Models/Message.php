<?php

namespace App\Containers\Message\Models;

use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Models\Model;

class Message extends Model
{
    protected $fillable = [
        'sender',
        'group_name',
        'img_url',
        'guest_id',
        'title',
        'content',
        'msg_type',
        'is_read',
    ];

    protected $attributes = [

    ];

    protected $hidden = [
        'guest_id',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'messages';

    public function guests()
    {
        return $this->belongsToMany(Guest::class);
    }
}
