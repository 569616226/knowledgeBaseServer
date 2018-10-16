<?php

namespace App\Containers\Question\UI\API\Transformers;

use App\Containers\Question\Models\Question;
use App\Ship\Parents\Transformers\Transformer;

class GuestQuestionTransformer extends Transformer
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

        $reader_ids = $entity->answer->readers()->get()->pluck('id')->toArray();
        $creator_id = optional($entity->answer->creator()->first())->id;
        $is_see = $creator_id == auth_user()->id || in_array(auth_user()->id, $reader_ids);

        if ($is_see) {
            $content = $entity->content;
        } else {
            $content = '请付费查看答案';
        }


        $response = [
            'object'     => 'Question',
            'id'         => $entity->getHashedKey(),
            'real_id'    => $entity->id,
            'content'    => $content,
            'guest_name' => $entity->guest->name,
            'created_at' => $entity->created_at->toDateTimeString(),
            'updated_at' => $entity->updated_at->toDateTimeString(),

        ];

        return $response;
    }
}
