<?php

namespace App\Containers\Topic\UI\API\Transformers\Mobile;

use App\Containers\Topic\Models\Topic;
use App\Ship\Parents\Transformers\Transformer;

class MobileTopicTransformer extends Transformer
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
     * @param Topic $entity
     *
     * @return array
     */
    public function transform(Topic $entity)
    {

        $status = [
            0 => '审核失败',
            1 => '审核通过',
        ];

        $ser_type = [
            0 => '线下约见',
            1 => '全国通话',
        ];

        $response = [
            'object'            => 'Topic',
            'id'                => $entity->getHashedKey(),
            'real_id'           => $entity->id,
            'status'            => $status[$entity->status] ?? '待审核',
            'title'             => $entity->title,
            'guest_name'        => $entity->guest->real_name,
            'guest_id'          => $entity->guest->real_id,
            'guest_avatar'      => $entity->guest->avatar,
            'guest_office'      => $entity->guest->office,
            'guest_location'    => $entity->guest->location,
            'guest_city'        => $entity->guest->city,
            'describe'          => html_entity_decode(stripslashes($entity->describe)),
            'price'             => $entity->price,
            'ser_time'          => $entity->ser_time ?? 1,
            'ser_type'          => $ser_type[$entity->ser_type],
            'need_infos'        => $entity->need_infos,
            'appoint_appraises' => $entity->appoints()->has('appoint_appraise')->get()->count(),
            'remark'            => $entity->remark,
            'created_at'        => $entity->created_at->toDateTimeString(),
            'updated_at'        => $entity->updated_at->toDateTimeString(),
            'deleted_at'        => $entity->deleted_at ? $entity->deleted_at->toDateTimeString() : null,
        ];

        return $response;
    }

}
