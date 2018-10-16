<?php

namespace App\Containers\Nav\UI\API\Transformers\Mobile;

use App\Containers\Answer\Models\Answer;
use App\Containers\Guest\Models\Guest;
use App\Ship\Parents\Transformers\Transformer;

class NavAnswerTransformer extends Transformer
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
    public function transform(Answer $entity)
    {

        $see_answer_price = get_see_answer_price();//查看问题价格
        $is_read = $entity->readers && in_array(auth_user()->id, $entity->readers->pluck('id')->toArray());//查看问题价格

        $question_guest = $entity->question->guest;
        $response = [
            'object'       => 'Answer',
            'id'           => $entity->getHashedKey(),
            'real_id'      => $entity->id,
            'guest_name'   => $question_guest->real_name,
            'guest_avatar' => $question_guest->avatar,
            'guest_office' => $question_guest->office,
            'readers'      => $entity->readers->count(),
            'star'         => $entity->star,
            'name'         => $entity->name,
            'price'        => $see_answer_price,
            'is_read'      => $is_read,
            'created_at'   => $entity->created_at->toDateTimeString(),
            'updated_at'   => $entity->updated_at->toDateTimeString(),
        ];

        return $response;
    }


}
