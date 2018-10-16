<?php

namespace App\Containers\Nav\UI\API\Transformers;

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
            'object'         => 'Nav',
            'id'             => $entity->getHashedKey(),
            'name'           => $entity->name,
            'pid'            => $entity->pid,
            'icon'           => $entity->icon,
            'user_name'      => $entity->user->name,
            'children_names' => implode('、', $entity->children->pluck('name')->toArray()),
            'created_at'     => $entity->created_at->toDateTimeString(),
            'updated_at'     => $entity->updated_at->toDateTimeString(),

        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            'deleted_at' => $entity->deleted_at ? $entity->deleted_at->toDateTimeString() : null,
        ], $response);

        return $response;
    }
}
