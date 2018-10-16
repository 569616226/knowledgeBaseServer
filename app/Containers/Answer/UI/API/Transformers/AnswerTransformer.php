<?php

namespace App\Containers\Answer\UI\API\Transformers;

use App\Containers\Answer\Models\Answer;
use App\Containers\Question\UI\API\Transformers\QuestionTransformer;
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
        $status = [
            0 => '待回答',
            1 => '已回答',
            2 => '已关闭',
            3 => '待付款',
        ];

        $response = [
            'object'        => 'Answer',
            'id'            => $entity->getHashedKey(),
            'name'          => $entity->name,
            'status'        => $status[$entity->status] ?? '待付款',
            'readers'       => $entity->readers()->count(),
            'price'         => $entity->price,
            'star'          => $entity->star,
            'creator_name'  => $entity->creator()->first()->name,
            'answer_name'   => optional($entity->question->guest)->real_name,
            'answer_avatar' => optional($entity->question->guest)->avatar,
            'answer_office' => optional($entity->question->guest)->office,
            'created_at'    => $entity->created_at->toDateTimeString(),
            'updated_at'    => $entity->updated_at->toDateTimeString(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
        ], $response);

        return $response;
    }

    public function includeQuestion(Answer $entity)
    {
        return $this->item($entity->question, new QuestionTransformer());
    }
}
