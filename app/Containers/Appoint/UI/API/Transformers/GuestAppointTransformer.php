<?php

namespace App\Containers\Appoint\UI\API\Transformers;

use App\Containers\Appoint\Models\Appoint;
use App\Ship\Parents\Transformers\Transformer;

class GuestAppointTransformer extends Transformer
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
            'object'        => 'Appoint',
            'id'            => $entity->getHashedKey(),
            'status'        => $status[$entity->status] ?? '待确认',
            'status_times'  => $entity->status_times,
            'case_time'     => $entity->case_id ? $entity->appoint_cases()->whereId($entity->case_id)->first()->appoint_time->toDateTimeString() : '约见未确认',
            'case_location' => $entity->case_id ? $entity->appoint_cases()->whereId($entity->case_id)->first()->location : '约见未确认',
            'topic_name'    => $entity->topic->title,
            'ser_type'     => $ser_type[$entity->topic->ser_type],
            'created_at'    => $entity->created_at->toDateTimeString(),
            'updated_at'    => $entity->updated_at->toDateTimeString(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
        ], $response);

        return $response;
    }


}
