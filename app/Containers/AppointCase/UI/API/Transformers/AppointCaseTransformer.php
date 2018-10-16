<?php

namespace App\Containers\AppointCase\UI\API\Transformers;

use App\Containers\AppointCase\Models\AppointCase;
use App\Ship\Parents\Transformers\Transformer;

class AppointCaseTransformer extends Transformer
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
     * @param AppointCase $entity
     *
     * @return array
     */
    public function transform(AppointCase $entity)
    {
        $response = [
            'object'       => 'AppointCase',
            'real_id'      => $entity->id,
            'location'     => $entity->location,
            'guest_name'   => $entity->guest->name,
            'appoint_time' => $entity->appoint_time->toDateTimeString(),
            'appoint_id'   => $entity->appoint_id,
        ];

        return $response;
    }
}
