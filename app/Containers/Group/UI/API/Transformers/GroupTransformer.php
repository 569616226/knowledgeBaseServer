<?php

namespace App\Containers\Group\UI\API\Transformers;

use App\Containers\Group\Models\Group;
use App\Ship\Parents\Transformers\Transformer;

class GroupTransformer extends Transformer
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
     * @param Group $entity
     *
     * @return array
     */
    public function transform(Group $entity)
    {
        $response = [
            'object'     => 'Group',
            'id'         => $entity->getHashedKey(),
            'name'       => $entity->name,
            'user_name'  => $entity->user->name,
            'created_at' => $entity->created_at->toDateTimeString(),
            'updated_at' => $entity->updated_at->toDateTimeString(),

        ];

        $response = $this->ifAdmin([
            'real_id'    => $entity->id,
            'deleted_at' => $entity->deleted_at ? $entity->deleted_at->toDateTimeString() : null,
        ], $response);

        return $response;
    }

}
