<?php

namespace App\Containers\Nav\UI\API\Transformers\Mobile;

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

        $children = $entity->children;
        foreach ($children as $child){
            $child->hashid = $child->getHashedKey();
        }

        $response = [
            'object'         => 'Nav',
            'id'             => $entity->id,
            'name'           => $entity->name,
            'icon'           => $entity->icon,
            'children'       => $children,
        ];

        return $response;
    }
}
