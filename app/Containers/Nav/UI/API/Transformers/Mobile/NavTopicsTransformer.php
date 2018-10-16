<?php

namespace App\Containers\Nav\UI\API\Transformers\Mobile;

use App\Containers\Guest\Models\Guest;
use App\Containers\Topic\Models\Topic;
use App\Ship\Parents\Transformers\Transformer;

class NavTopicsTransformer extends Transformer
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

        $complate_appoints = $entity->appoints()->whereStatus(5)->get()->count();

        /*喜欢大咖的人数*/
        $guests = Guest::all();
        $likes = $guests->filter(function ($value, $key) use ($entity) {
            return is_array($value->like_linkas) && in_array($entity->guest->id, $value->like_linkas);
        })->count();

        $response = [
            'object'     => 'Topic',
            'id'         => $entity->getHashedKey(),
            'name'       => $entity->title,
            'real_id'    => $entity->id,
            'real_name'  => $entity->guest->real_name,
            'guest_id'   => $entity->guest->getHashedKey(),
            'avatar'     => $entity->guest->avatar,
            'office'     => $entity->guest->office,
            'like'       => $likes,
            'helps'      => $complate_appoints,
            'appraises'  => $complate_appoints,
            'price'      => $entity->price,
            'created_at' => $entity->created_at->toDateTimeString(),
            'updated_at' => $entity->updated_at->toDateTimeString(),
        ];

        return $response;
    }


}
