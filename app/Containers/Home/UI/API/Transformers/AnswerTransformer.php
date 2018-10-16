<?php

namespace App\Containers\Home\UI\API\Transformers;

use App\Containers\Answer\Models\Answer;
use App\Ship\Parents\Transformers\Transformer;

class AnswerTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [
//        'question'
    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [
        'question'
    ];

    /**
     * @param Answer $entity
     *
     * @return array
     */
    public function transform(Answer $entity)
    {
        $is_reader = in_array(auth_user()->id, $entity->readers->pluck('id')->toArray());
        $response = [
            'object'        => 'Answer',
            'id'            => $entity->getHashedKey(),
            'real_id'       => $entity->id,
            'name'          => $entity->name,
            'star'          => $entity->star,
            'price'         => $entity->price,
            'readers'       => $entity->readers->count(),
            'is_reader'     => $is_reader,
            'answer_name'   => optional($entity->question->guest)->real_name,
            'answer_office' => optional($entity->question->guest)->office,
            'answer_avatar' => optional($entity->question->guest)->avatar,
        ];

        return $response;
    }

}
