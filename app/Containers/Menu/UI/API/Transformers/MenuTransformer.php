<?php

namespace App\Containers\Menu\UI\API\Transformers;

use App\Containers\Menu\Models\Menu;
use App\Ship\Parents\Transformers\Transformer;

class MenuTransformer extends Transformer
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
     * @param Menu $entity
     *
     * @return array
     */
    public function transform(Menu $entity)
    {

        $response = [
            'object'    => 'Menu',
            'id'        => $entity->getHashedKey(),
            'name'      => $entity->name,
            'parent_id' => $entity->parent_id,
            'url'       => $entity->url,
            'icon'      => $entity->icon,
            'children'  => $entity->children,
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
        ], $response);

        return $response;
    }
}
