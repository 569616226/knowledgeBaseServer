<?php

namespace App\Containers\Chat\Models;

use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Models\Model;

class Chat extends Model
{
    protected $fillable = [
        'content',
        'pid',
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
    protected $resourceKey = 'chats';

    public function guests()
    {
        return $this->belongsToMany(Guest::class)->withPivot('is_sender')->withPivot('reciver_or_sender_id')->withPivot('is_last');
    }

    public function sender()
    {
        return $this->belongsToMany(Guest::class)->withPivot('is_sender')->withPivot('reciver_or_sender_id')->wherePivot('is_sender', 1);
    }

    public function reciver()
    {
        return $this->belongsToMany(Guest::class)->withPivot('is_sender')->withPivot('reciver_or_sender_id')->wherePivot('is_sender', 0);
    }


}
