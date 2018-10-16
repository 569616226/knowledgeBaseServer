<?php

namespace App\Containers\Nav\UI\API\Transformers\Mobile;

use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Transformers\Transformer;

class NavLinkaTransformer extends Transformer
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

        $complate_appoints = $entity->appoints()->whereStatus(5)->get()->count();
        $complate_answers = $entity->questions()->whereNotNull('content')->get()->count();

        $response = [
            'object'     => 'Guest',
            'id'         => $entity->getHashedKey(),
            'real_id'    => $entity->id,
            'real_name'  => $entity->real_name,
            'avatar'     => $entity->avatar,
            'office'     => $entity->office,
            'helps'      => $complate_answers + $complate_appoints,
            'appraises'  => $complate_appoints,
            'created_at' => $entity->created_at->toDateTimeString(),
            'updated_at' => $entity->updated_at->toDateTimeString(),
        ];

        return $response;
    }


}
