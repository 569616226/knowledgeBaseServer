<?php

namespace App\Containers\Home\UI\API\Transformers;

use App\Containers\Nav\Models\Nav;
use App\Ship\Parents\Transformers\Transformer;

class NavTransformer extends Transformer
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
     * @param Nav $entity
     *
     * @return array
     */
    public function transform(Nav $entity)
    {
        $response = [
            'id'                     => $entity->getHashedKey(),
            'name'                   => $entity->name,
            'icon'                   => $entity->icon,
            'first_children_id'      => optional($entity->children->first())->getHashedKey(),
            'first_children_real_id' => optional($entity->children->first())->id,
        ];

        return $response;
    }
}
