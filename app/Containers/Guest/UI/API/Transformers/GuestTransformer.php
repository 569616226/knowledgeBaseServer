<?php

namespace App\Containers\Guest\UI\API\Transformers;

use App\Containers\Group\UI\API\Transformers\GroupTransformer;
use App\Containers\Guest\Models\Guest;
use App\Containers\Nav\UI\API\Transformers\NavTransformer;
use App\Ship\Parents\Transformers\Transformer;

class GuestTransformer extends Transformer
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
            'object'        => 'Guest',
            'id'            => $entity->getHashedKey(),
            'open_id'       => $entity->open_id,
            'name'          => $entity->name,
            'avatar'        => $entity->avatar,
            'phone'         => $entity->phone,
            'city'          => $entity->city,
            'status_txt'    => $status[$entity->status] ?? '普通用户',
            'gender_txt'    => $gender[$entity->gender] ?? '未知',
            'like_linkas'   => $entity->like_linkas,
            'viewed_linkas' => $entity->viewed_linkas,
            'wallets'       => $entity->wallets,
            'groups_ids'    => $entity->groups->pluck('id')->toArray(),
            'groups_name'   => implode('、', $entity->groups->pluck('name')->toArray()),
            'created_at'    => $entity->created_at->toDateTimeString(),
            'updated_at'    => $entity->updated_at->toDateTimeString(),
        ];

        $response = $this->ifAdmin([
            'real_id' => $entity->id,
        ], $response);

        return $response;
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
