<?php

namespace App\Containers\Advert\UI\API\Transformers;

use App\Containers\Advert\Models\Advert;
use App\Ship\Parents\Transformers\Transformer;

class AdvertTransformer extends Transformer
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
     * @param Advert $entity
     *
     * @return array
     */
    public function transform(Advert $entity)
    {
        $response = [
            'id'         => $entity->getHashedKey(),
            'name'       => $entity->name,
            'path'       => $entity->path,
            'url'        => $entity->url,
            'type'       => $entity->type,
            'order'      => $entity->order,
            'user_name'  => $entity->user->name,
            'created_at' => $entity->created_at->toDateTimeString(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
        ], $response);

        return $response;
    }
}
