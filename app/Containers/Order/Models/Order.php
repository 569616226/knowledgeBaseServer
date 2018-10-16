<?php

namespace App\Containers\Order\Models;

use App\Containers\Answer\Models\Answer;
use App\Containers\Appoint\Models\Appoint;
use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Models\Model;

class Order extends Model
{
    protected $fillable = [
        'name',
        'order_no',
        'guest_id',
        'answer_id',
        'appoint_id',
        'price',
        'pay_type',
        'answer_type',
        'status',
        'pay_time',
        'cancel_res',
        'payee',
        'is_cancel',
        'cancel_appoint_id',

        'refund_status',
        'refund_type',
        'refund_way',
        'refund_remark',

        'refund_auditor',
        'refund_audit_status',
        'refund_audit_time',
        'refund_audit_remark',

    ];

    protected $attributes = [
    ];

    protected $hidden = [
    ];

    protected $casts = [
        'is_cancel' => 'boolean',
    ];

    protected $dates = [
        'refund_audit_time',
        'pay_time',
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = 'orders';

    /*問答*/
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    /*預約*/
    public function appoint()
    {
        return $this->belongsTo(Appoint::class);
    }

    /*下單人*/
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

}
