<?php

namespace App\Containers\Order\UI\API\Transformers;

use App\Containers\Guest\UI\API\Transformers\GuestTransformer;
use App\Containers\Order\Models\Order;
use App\Ship\Parents\Transformers\Transformer;

class AnswerOrderTransformer extends Transformer
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
        $answer_type = [
            0 => '提问题',
            1 => '看答案',
        ];
        $answer_status = [
            0 => '待回答',
            1 => '已回答',
            2 => '已关闭',
            3 => '待付款',
        ];

        $response = [
            'object'        => 'Order',
            'id'            => $entity->getHashedKey(),
            'name'          => $entity->name,
            'guest_name'    => $entity->guest->name,
            'order_no'      => $entity->order_no,
            'price'         => $entity->price,
            'pay_type'      => $pay_type[$entity->pay_type] ?? '微信支付',
            'status'        => $status[$entity->status] ?? '待付款',
            'answer_type'   => $answer_type[$entity->answer_type] ?? '提问题',
            'answer_status' => $answer_status[$entity->answer->status],
            'pay_time'      => $entity->pay_time ? $entity->pay_time->toDateTimeString() : null,
            'created_at'    => $entity->created_at->toDateTimeString(),
            'updated_at'    => $entity->updated_at->toDateTimeString(),
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
