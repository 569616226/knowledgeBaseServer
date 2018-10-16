<?php

namespace App\Containers\Home\UI\API\Transformers;

use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Transformers\Transformer;

class LinkaTransformer extends Transformer
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
     * @param Guest $entity
     *
     * @return array
     */
    public function transform(Guest $entity)
    {
        $response = [
            'object'         => 'Guest',
            'id'             => $entity->getHashedKey(),
            'real_id' => $entity->id,
            'real_name'      => $entity->real_name,
            'avatar'         => $entity->avatar,
            'office'         => $entity->office,
        ];

        return $response;
    }

}
