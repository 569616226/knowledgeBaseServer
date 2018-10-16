<?php

namespace App\Containers\Answer\UI\API\Transformers;

use App\Containers\Answer\Models\Answer;
use App\Containers\Guest\UI\API\Transformers\NavLinkaTransformer;
use App\Ship\Parents\Transformers\Transformer;

class GuestAnswerTransformer extends Transformer
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

        if (!$entity->question->content) {

            $is_see_content = true;

        } else {

            /*问题的创建者，问题查看人，问题的回答人*/
            $answer_guest_ids = $entity->guests->pluck('id')->toArray();

            array_push($answer_guest_ids, $entity->question->guest->id);

            $is_see_content = in_array(auth_user()->id, $answer_guest_ids);

        }

        $answer_display_time = get_ansewr_order_cancel_time();//问答订单自动关闭时间

        $diffInHours = $entity->created_at->addHours($answer_display_time)->diffInHours(now());
        $diffInMinutes = $entity->created_at->addHours($answer_display_time)->diffInMinutes(now()) - $diffInHours * 60;

        $display_time = $diffInHours . '小时' . $diffInMinutes . '分钟';

        $response = [
            'object'         => 'Answer',
            'id'             => $entity->getHashedKey(),
            'name'           => $entity->name,
            'status'         => $status[$entity->status] ?? '待付款',
            'star'           => $entity->star ?? 0,
            'price'          => $entity->price,
            'linka_name'     => $entity->question->guest->real_name,
            'linka_id'       => $entity->question->guest->id,
            'linka_hash_id'  => $entity->question->guest->getHashedKey(),
            'linka_avatar'   => $entity->question->guest->avatar,
            'linka_office'   => $entity->question->guest->office,
            'is_see_content' => $is_see_content,
            'display_time'   => $display_time,
            'guest_name'     => $entity->creator()->first()->name,
            'is_guest'       => auth_user()->id == $entity->creator()->first()->id,
            'readers'        => $entity->readers()->orderBy('created_at', 'desc')->take(10)->get()->pluck('avatar')->toArray(),
            'created_at'     => $entity->created_at->toDateTimeString(),
            'updated_at'     => $entity->updated_at->toDateTimeString(),
        ];

        if ($is_see_content) {
            $response = array_merge($response, ['content' => $entity->question->content]);
        }

        return $response;
    }


}
