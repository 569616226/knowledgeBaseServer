<?php

namespace App\Containers\Home\UI\API\Transformers;

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

        $ser_type = [
            0 => '线下约见',
            1 => '全国通话',
        ];

        $response = [
            'object'       => 'Topic',
            'id'           => $entity->getHashedKey(),
            'title'        => $entity->title,
            'guest_name'   => $entity->guest->real_name,
            'guest_id'     => $entity->guest->getHashedKey(),
            'guest_cover'  => $entity->guest->cover,
            'guest_office' => $entity->guest->office,
            'helps'        => $entity->appoints()->whereStatus(5)->get()->count(),
            'price'        => $entity->price,
            'ser_type'     => $ser_type[$entity->ser_type],
        ];

        return $response;
    }


}
