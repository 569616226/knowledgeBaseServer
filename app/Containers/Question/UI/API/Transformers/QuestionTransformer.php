<?php

namespace App\Containers\Question\UI\API\Transformers;

use App\Containers\Question\Models\Question;
use App\Ship\Parents\Transformers\Transformer;

class QuestionTransformer extends Transformer
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
     * @param Question $entity
     *
     * @return array
     */
    public function transform(Question $entity)
    {
        $response = [
            'object'     => 'Question',
            'id'         => $entity->getHashedKey(),
            'content'    => $entity->content,
            'guest_name' => $entity->guest->name,
            'created_at' => $entity->created_at,
            'updated_at' => $entity->updated_at,

        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
        ], $response);


        return $response;
    }
}
