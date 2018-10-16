<?php

namespace App\Containers\Chat\UI\API\Transformers;

use App\Containers\Chat\Models\Chat;
use App\Ship\Parents\Transformers\Transformer;

class NewChatsTransformer extends Transformer
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

        /*
         * 显示 消息发送者的名字和头像
         *
         * */
        $sender = $entity->sender()->first();//消息发送人
        $reciver = $entity->reciver()->first();//消息发送人



        $response = [
            'object'       => 'Chat',
            'id'           => $entity->getHashedKey(),

            'content'      => $entity->content,
            'real_id'      => $entity->id,
            'created_at'   => $entity->created_at->toDateTimeString(),
            'updated_at'   => $entity->updated_at->toDateTimeString(),

        ];

        if($sender && $reciver){

            $real_name = $sender->real_name;
            $avatar = $sender->avatar;
            $guest_id = auth_user()->id == $reciver->id ? $sender->id: $reciver->id;

            $response = array_merge($response,[
                'guest_name'   => $real_name,
                'guest_id'     => $guest_id,
                'guest_avatar' => $avatar,
            ]);
        }


        return $response;
    }
}
