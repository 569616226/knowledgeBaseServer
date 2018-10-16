<?php

namespace App\Containers\Order\UI\API\Transformers;

use App\Containers\Guest\UI\API\Transformers\GuestTransformer;
use App\Containers\Order\Models\Order;
use App\Ship\Parents\Transformers\Transformer;

class CaseOrderTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    /**
     * @param Order $entity
     *
     * @return array
     */
    public function transform(Order $entity)
    {

        $refund_way = [
            0 => '原路退回',
            1 => '微信钱包',
        ];

        $refund_audit_status = [
            0 => '审核失败',
            1 => '审核通过',
            2 => '待审核',
        ];

        $refund_status = [
            0 => '转账失败',
            1 => '转账通过',
            2 => '待转账',
        ];

        $response = [
            'object'              => 'Order',
            'id'                  => $entity->getHashedKey(),
            'guest_name'          => $entity->guest->name,
            'price'               => $entity->price,
            'refund_way'          => $refund_way[$entity->refund_way] ?? '原路退回',
            'refund_status'       => $refund_status[$entity->refund_status] ?? '待转账',
            'refund_auditor'      => $entity->refund_auditor,
            'refund_audit_status' => $refund_audit_status[$entity->refund_audit_status] ?? '审核失败',
            'refund_audit_time'   => $entity->refund_audit_time ? $entity->refund_audit_time->toDateTimeString() : null,
            'refund_audit_remark' => $entity->refund_audit_remark,
            'created_at'          => $entity->created_at->toDateTimeString(),
            'updated_at'          => $entity->updated_at->toDateTimeString(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
            // 'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }

    public function includeGuest(Order $entity)
    {
        return $this->item($entity->guest, new GuestTransformer());
    }
}
