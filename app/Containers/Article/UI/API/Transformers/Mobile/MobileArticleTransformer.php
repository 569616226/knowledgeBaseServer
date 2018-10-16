<?php

namespace App\Containers\Article\UI\API\Transformers\Mobile;

use App\Containers\Article\Models\Article;
use App\Containers\Comment\UI\API\Transformers\CommentTransformer;
use App\Ship\Parents\Transformers\Transformer;

class MobileArticleTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [
        'comments'
    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [
        'comments'
    ];

    protected $status = [
        0 => '审核失败',
        1 => '审核通过',
        2 => '待审核',
    ];

    /**
     * @param Article $entity
     *
     * @return array
     */
    public function transform(Article $entity)
    {

        $like_guest_ids = $entity->like ?? [];

        $response = [
            'object'         => 'Article',
            'id'             => $entity->getHashedKey(),
            'title'          => $entity->title,
            'cover'          => $entity->cover,
            'real_id'        => $entity->id,
            'content'        => html_entity_decode(stripslashes($entity->content)),
            'guest_name'     => $entity->guest->real_name,
            'guest_cover'    => $entity->guest->cover,
            'guest_office'   => $entity->guest->office,
            'status'         => $this->status[$entity->status],
            'remark'         => $entity->remark,
            'readers'        => $entity->readers,
            'comment_counts' => $entity->comments->count(),
            'like'           => count($like_guest_ids),
            'auditor'        => $entity->auditor,
            'is_like'        => in_array(auth_user()->id, $like_guest_ids),
            'audit_time'     => $entity->audit_time ? $entity->audit_time->toDateTimeString() : null,
            'created_at'     => $entity->created_at->toDateString(),
            'updated_at'     => $entity->updated_at->toDateTimeString(),
        ];

        return $response;

    }

    public function includeComments(Article $entity)
    {
        return $this->collection($entity->comments, new CommentTransformer());
    }
}
