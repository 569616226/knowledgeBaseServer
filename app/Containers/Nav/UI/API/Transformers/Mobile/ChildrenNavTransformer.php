<?php

namespace App\Containers\Nav\UI\API\Transformers\Mobile;

use App\Containers\Nav\Models\Nav;
use App\Ship\Parents\Transformers\Transformer;

class ChildrenNavTransformer extends Transformer
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
            'object'  => 'Nav',
            'id'      => $entity->getHashedKey(),
            'real_id' => $entity->id,
            'name'    => $entity->name,
            'icon'    => $entity->icon,
        ];

        return $response;
    }
}
