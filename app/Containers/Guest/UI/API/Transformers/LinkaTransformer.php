<?php

namespace App\Containers\Guest\UI\API\Transformers;

use App\Containers\Article\UI\API\Transformers\ArticleTransformer;
use App\Containers\Group\UI\API\Transformers\GroupTransformer;
use App\Containers\Guest\Models\Guest;
use App\Containers\Nav\UI\API\Transformers\NavTransformer;
use App\Containers\Topic\UI\API\Transformers\TopicTransformer;
use App\Ship\Parents\Transformers\Transformer;

class LinkaTransformer extends Transformer
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
        'groups',
        'navs',
    ];

    /**
     * @param Guest $entity
     *
     * @return array
     */
    public function transform(Guest $entity)
    {

        $status = [
            0 => '审核失败',
            1 => '审核成功',
            2 => '待审核',
        ];

        $gender = [
            0 => '女',
            1 => '男',
        ];

        $response = [
            'object'         => 'Guest',
            'id'             => $entity->getHashedKey(),
            'open_id'        => $entity->open_id,
            'name'           => $entity->name,
            'real_name'      => $entity->real_name,
            'avatar'         => $entity->avatar,
            'phone'          => $entity->phone,
            'email'          => $entity->email,
            'we_name'        => $entity->we_name,
            'city'           => $entity->city,
            'single_profile' => $entity->single_profile,
            'office'         => $entity->office,
            'cover'          => $entity->cover,
            'location'       => $entity->location,
            'card_id'        => $entity->card_id,
            'card_pic'       => $entity->card_pic,
            'referee'        => $entity->referee,
            'remark'         => $entity->remark,
            'profile'        => html_entity_decode(stripslashes($entity->profile)),
            'status'         => $entity->status,
            'status_txt'     => $status[$entity->status] ?? '普通用户',
            'gender'         => $entity->gender,
            'audit_time'     => $entity->audit_time ? $entity->audit_time->toDateTimeString() : null,
            'auditor'        => $entity->auditor,
            'gender_txt'     => $gender[$entity->gender] ?? '未知',
            'groups_ids'     => $entity->groups->pluck('id')->toArray(),
            'groups_name'    => implode('、', $entity->groups->pluck('name')->toArray()),
            'navs_name'      => implode('、', $entity->navs->pluck('name')->toArray()),
            'navs_ids'       => $entity->navs->pluck('id')->toArray(),
            'wallets'        =>  $entity->wallets,
            'system_msgs'   => $entity->messages()->where('is_read', 0)->get()->count(),
            'chats'         => $entity->chats()->where('is_read', 0)->get()->count(),
            'created_at'     => $entity->created_at->toDateTimeString(),
            'updated_at'     => $entity->updated_at->toDateTimeString(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
        ], $response);

        return $response;
    }

    public function includeArticles(Guest $entity)
    {
        return $this->collection($entity->articles, new ArticleTransformer());
    }

    public function includeTopics(Guest $entity)
    {
        return $this->collection($entity->topics, new TopicTransformer());
    }

    public function includeGroups(Guest $entity)
    {
        return $this->collection($entity->groups, new GroupTransformer());
    }

    public function includeNavs(Guest $entity)
    {
        return $this->collection($entity->navs, new NavTransformer());
    }
}
