<?php

namespace App\Containers\Appoint\Models;

use App\Containers\AppointAppraise\Models\AppointAppraise;
use App\Containers\AppointCase\Models\AppointCase;
use App\Containers\Guest\Models\Guest;
use App\Containers\Order\Models\Order;
use App\Containers\Topic\Models\Topic;
use App\Ship\Parents\Models\Model;

class Appoint extends Model
{
    protected $fillable = [
        'status',
        'cancel_res',
        'canceler',
        'answers',
        'profile',
        'topic_id',
        'guest_id',
        'case_id',
    ];

    protected $attributes = [

    ];

    protected $hidden = [
    ];

    protected $casts = [
        'answers' => 'array',
        'status_times' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'appoints';

    /*訂單*/
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /*預約者*/
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    /*話題*/
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /*約見方案*/
    public function appoint_cases()
    {
        return $this->hasMany(AppointCase::class);
    }

    /*約見評論*/
    public function appoint_appraise()
    {
        return $this->hasOne(AppointAppraise::class);
    }

}
