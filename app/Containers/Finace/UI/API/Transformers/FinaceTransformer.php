<?php

namespace App\Containers\Finace\UI\API\Transformers;

use App\Containers\Finace\Models\Finace;
use App\Ship\Parents\Transformers\Transformer;

class FinaceTransformer extends Transformer
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
     * @param Finace $entity
     *
     * @return array
     */
    public function transform(Finace $entity)
    {
        $response = [
            'object'      => 'Finace',
            'id'          => $entity->getHashedKey(),
            'name'        => $entity->name,
            'order_name'  => $entity->order_name,
            'order_no'    => $entity->order_no,
            'price'       => $entity->price,
            'finace_type' => $entity->type == 5 ? '支出' : '收入',
            'guest_name'  => $entity->guest->name,
            'created_at'  => $entity->created_at->toDateTimeString(),
            'updated_at'  => $entity->updated_at->toDateTimeString(),

        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
            // 'deleted_at' => $entity->deleted_at,
        ], $response);

        return $response;
    }
}
