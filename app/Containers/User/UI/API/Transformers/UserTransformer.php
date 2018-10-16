<?php

namespace App\Containers\User\UI\API\Transformers;

use App\Containers\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\User\Models\User;
use App\Ship\Parents\Transformers\Transformer;

/**
 * Class UserTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserTransformer extends Transformer
{

    /**
     * @var  array
     */
    protected $availableIncludes = [
        'roles',
    ];

    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @param \App\Containers\User\Models\User $user
     *
     * @return array
     */
    public function transform(User $user)
    {
        $response = [
            'object'    => 'User',
            'id'        => $user->getHashedKey(),
            'name'      => $user->name,
            'email'     => $user->email,
            'confirmed' => $user->confirmed,
            'nickname'  => $user->nickname,
            'gender'    => $user->gender,
            'role_names'     => implode('、',$user->roles->pluck('name')->toArray()),
            'is_frozen' => $user->is_frozen,

            'created_at'          => $user->created_at->toDateTimeString(),
            'updated_at'          => $user->updated_at->toDateTimeString(),
        ];

        $response = $this->ifAdmin([
            'real_id'    => $user->id,
            'deleted_at' => $user->deleted_at,
        ], $response);

        return $response;
    }

    public function includeRoles(User $user)
    {
        return $this->collection($user->roles, new RoleTransformer());
    }

}
