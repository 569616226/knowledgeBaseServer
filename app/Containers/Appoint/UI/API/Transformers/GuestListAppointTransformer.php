<?php

namespace App\Containers\Appoint\UI\API\Transformers;

use App\Containers\Appoint\Models\Appoint;
use App\Ship\Parents\Transformers\Transformer;

class GuestListAppointTransformer extends Transformer
{

    /**
     * @param Appoint $entity
     *
     * @return array
     */
    public function transform(Appoint $entity)
    {
        $status = [
            0 => '已取消',
            1 => '待付款',
            3 => '待见面',
            4 => '待评价',
            5 => '已完成',
            6 => '已拒绝',
        ];

        $ser_type = [
            0 => '线下约见',
            1 => '全国通话',
        ];

        $response = [
            'object'         => 'Appoint',
            'id'             => $entity->getHashedKey(),
            'status'         => $status[$entity->status] ?? '待确认',
            'status_times'   => $entity->status_times,
            'guest_name'     => $entity->topic->guest->real_name,
            'guest_avatar'   => $entity->topic->guest->avatar,
            'guest_office'   => $entity->topic->guest->office,
            'topic_price'    => $entity->topic->price,
            'topic_ser_time' => $entity->topic->ser_time,
            'topic_ser_type' => $ser_type[$entity->topic->ser_type],
            'created_at'     => $entity->created_at->toDateTimeString(),
            'updated_at'     => $entity->updated_at->toDateTimeString(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
        ], $response);

        return $response;
    }

}
