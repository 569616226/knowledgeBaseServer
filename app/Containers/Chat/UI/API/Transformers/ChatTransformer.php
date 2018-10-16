<?php

namespace App\Containers\Chat\UI\API\Transformers;

use App\Containers\Chat\Models\Chat;
use App\Ship\Parents\Transformers\Transformer;

class ChatTransformer extends Transformer
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
     * @param Chat $entity
     *
     * @return array
     */
    public function transform(Chat $entity)
    {

        if ($entity->pivot->is_sender) {

            $is_send = true;

        } else {

            $is_send = false;

        }

        /*获取发送者名字*/
        $real_name = null;
        $avatar = null;
        $guest_id = null;

        $guest = $entity->sender()->first();

        if($guest){

            $real_name = $guest->real_name;
            $avatar = $guest->avatar;
            $guest_id = $guest->id;

        }

        $response = [
            'object'       => 'Chat',
            'id'           => $entity->getHashedKey(),
            'guest_name'   => $real_name,
            'guest_avatar' => $avatar,
            'guest_id'     => $guest_id,
            'content'      => $entity->content,
            'real_id'      => $entity->id,
            'is_send'      => $is_send,
            'created_at'   => $entity->created_at->toDateTimeString(),
            'updated_at'   => $entity->updated_at->toDateTimeString(),
        ];

        return $response;
    }
}
