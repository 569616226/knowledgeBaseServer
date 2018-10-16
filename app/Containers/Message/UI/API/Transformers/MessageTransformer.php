<?php

namespace App\Containers\Message\UI\API\Transformers;

use App\Containers\Message\Models\Message;
use App\Ship\Parents\Transformers\Transformer;

class MessageTransformer extends Transformer
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

    protected $msg_type = [
        0 => '系统消息',
        1 => '图文',
        2 => '纯文本',
    ];

    /**
     * @param Message $entity
     *
     * @return array
     */
    public function transform(Message $entity)
    {
        $response = [
            'object'        => 'Message',
            'id'            => $entity->getHashedKey(),
            'sender'        => $entity->sender,
            'group_name'    => $entity->group_name,
            'img_url'       => $entity->img_url,
            'reciver_names' => implode('、', $entity->guests->pluck('name')->toArray()),
            'title'         => $entity->title,
            'content'       => html_entity_decode(stripslashes($entity->content)),
            'is_read'       => $entity->is_read,
            'msg_type'      => $this->msg_type[$entity->msg_type],
            'created_at'    => $entity->created_at->toDateTimeString(),
            'updated_at'    => $entity->updated_at->toDateTimeString(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
        ], $response);

        return $response;
    }

}
