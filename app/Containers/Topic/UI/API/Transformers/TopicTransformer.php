<?php

namespace App\Containers\Topic\UI\API\Transformers;

use App\Containers\Appoint\UI\API\Transformers\AppointTransformer;
use App\Containers\Guest\UI\API\Transformers\LinkaTransformer;
use App\Containers\Topic\Models\Topic;
use App\Ship\Parents\Transformers\Transformer;

class TopicTransformer extends Transformer
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

        $appoint_news = $entity->appoints()->whereIn('status',[1,3,4,5])->orderBy('updated_at', 'desc')->first();

        $response = [
            'object'             => 'Topic',
            'id'                 => $entity->getHashedKey(),
            'status'             => $status[$entity->status] ?? '待审核',
            'title'              => $entity->title,
            'guest_id'           => $entity->guest->getHashedKey(),
            'guest_name'         => $entity->guest->real_name,
            'guest_avatar'       => $entity->guest->avatar,
            'guest_office'       => $entity->guest->office,
            'guest_phone'        => $entity->guest->phone,
            'appoint_guest_name' =>$appoint_news ? $appoint_news->guest->name : null,
            'describe'           => html_entity_decode(stripslashes($entity->describe)),
            'price'              => $entity->price,
            'ser_time'           => $entity->ser_time ?? 1,
            'ser_type'           => $ser_type[$entity->ser_type],
            'need_infos'         => $entity->need_infos,
            'remark'             => $entity->remark,
            'created_at'         => $entity->created_at->toDateTimeString(),
            'updated_at'         => $entity->updated_at->toDateTimeString(),
        ];



        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }

    public function includeAppoints(Topic $topic)
    {
        return $this->collection($topic->appoints, new AppointTransformer());
    }

    public function includeGuest(Topic $topic)
    {
        return $this->item($topic->guest, new LinkaTransformer());
    }
}
