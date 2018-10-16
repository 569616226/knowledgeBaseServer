<?php

namespace App\Containers\Comment\UI\API\Transformers;

use App\Containers\Comment\Models\Comment;
use App\Ship\Parents\Transformers\Transformer;

class CommentTransformer extends Transformer
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
     * @param Comment $entity
     *
     * @return array
     */
    public function transform(Comment $entity)
    {
        $response = [
            'id'                 => $entity->getHashedKey(),
            'real_id'            => $entity->id,
            'comment_user'       => $entity->guest->name,
            'comment_user_image' => $entity->guest->avatar,
            'content'            => $entity->content,
            'created_at'         => $entity->created_at->toDateTimeString(),
        ];

        if(auth_user()){
            $response = array_merge(['is_del' => auth_user()->id == $entity->guest_id],$response);
        }

        return $response;
    }
}
