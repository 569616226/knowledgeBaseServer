<?php

namespace App\Containers\Home\UI\API\Transformers;

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
            'image' => $entity->path,
            'link'  => $entity->url,
        ];

        return $response;
    }
}
