<?php

namespace App\Containers\Order\UI\API\Transformers;

use App\Containers\Guest\UI\API\Transformers\GuestTransformer;
use App\Containers\Order\Models\Order;
use App\Ship\Parents\Transformers\Transformer;

class OrderTransformer extends Transformer
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
        $appoint_status = [
            0 => '已取消',
            1 => '待付款',
            3 => '待见面',
            4 => '待评价',
            5 => '已完成',
            6 => '已拒绝',
        ];

        $status = [
            0 => '已关闭',
            1 => '已付款',
            3 => '退款中',
            4 => '已退款',
            5 => '已完成',
            6 => '支付失败',
        ];
        $pay_type = [
            0 => '微信支付'
        ];
        $refund_audit_status = [
            0 => '审核失败',
            1 => '审核通过',
            2 => '待审核',
        ];

        $response = [
            'object'              => 'Order',
            'id'                  => $entity->getHashedKey(),
            'name'                => $entity->name,
            'guest_name'          => $entity->guest->name,
            'order_no'            => $entity->order_no,
            'price'               => $entity->price,
            'pay_type'            => $pay_type[$entity->pay_type] ?? '微信支付',
            'status'              => $status[$entity->status] ?? '待付款',
            'appoint_status'      => $appoint_status[$entity->appoint->status] ?? '待确认',
            'refund_audit_status' => $refund_audit_status[$entity->refund_audit_status] ?? '审核失败',
            'pay_time'            => $entity->pay_time ? $entity->pay_time->toDateTimeString() : null,
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
