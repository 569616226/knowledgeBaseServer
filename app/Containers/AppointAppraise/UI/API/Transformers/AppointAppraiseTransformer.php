<?php

namespace App\Containers\AppointAppraise\UI\API\Transformers;

use App\Containers\AppointAppraise\Models\AppointAppraise;
use App\Ship\Parents\Transformers\Transformer;

class AppointAppraiseTransformer extends Transformer
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
     * @param AppointAppraise $entity
     *
     * @return array
     */
    public function transform(AppointAppraise $entity)
    {
        $response = [
            'object'       => 'AppointAppraise',
            'id'           => $entity->getHashedKey(),
            'star'         => $entity->star,
            'degree'       => $entity->degree,
            'content'      => $entity->content,
            'guest_name'   => $entity->guest->name,
            'guest_avatar' => $entity->guest->avatar,
            'topic_name'   => $entity->appoint->topic->title,
            'created_at'   => $entity->created_at->toDateTimeString(),
            'updated_at'   => $entity->updated_at->toDateTimeString(),

        ];

        return $response;
    }
}
