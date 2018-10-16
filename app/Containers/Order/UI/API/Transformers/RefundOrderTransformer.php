<?php

namespace App\Containers\Order\UI\API\Transformers;

use App\Containers\Guest\UI\API\Transformers\GuestTransformer;
use App\Containers\Order\Models\Order;
use App\Ship\Parents\Transformers\Transformer;

class RefundOrderTransformer extends Transformer
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

        $refund_type = [
            0 => '约见取消退款',
            1 => '问题关闭退款',
        ];

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
            'name'                => $entity->name,
            'guest_name'          => $entity->guest->name,
            'order_no'            => $entity->order_no,
            'price'               => $entity->price,
            'pay_type'            => $pay_type[$entity->pay_type] ?? '微信支付',
            'status'              => $status[$entity->status] ?? '待付款',
            'cancel_res'          => $entity->cancel_res,
            'payee'               => $entity->payee,
            'refund_type'         => $refund_type[$entity->refund_type] ?? '约见取消退款',
            'refund_way'          => $refund_way[$entity->refund_way] ?? '原路退回',
            'refund_remark'       => $entity->refund_remark,
            'refund_status'       => $refund_status[$entity->refund_status] ?? null,
            'refund_auditor'      => $entity->refund_auditor,
            'refund_audit_status' => $refund_audit_status[$entity->refund_audit_status] ?? '审核失败',
            'refund_audit_time'   => $entity->refund_audit_time ? $entity->refund_audit_time->toDateTimeString() : null,
            'refund_audit_remark' => $entity->refund_audit_remark,
            'pay_time'            => $entity->pay_time ? $entity->pay_time->toDateTimeString() : null,
            'created_at'          => $entity->created_at->toDateTimeString(),
            'updated_at'          => $entity->updated_at->toDateTimeString(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
        ], $response);

        return $response;
    }

    public function includeGuest(Order $entity)
    {
        return $this->item($entity->guest, new GuestTransformer());
    }
}
