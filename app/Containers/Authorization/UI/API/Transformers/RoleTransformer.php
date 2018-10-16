<?php

namespace App\Containers\Authorization\UI\API\Transformers;

use App\Containers\Authorization\Models\Role;
use App\Containers\Menu\UI\API\Transformers\MenuTransformer;
use App\Ship\Parents\Transformers\Transformer;

/**
 * Class RoleTransformer.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RoleTransformer extends Transformer
{

    protected $availableIncludes = [

    ];

    protected $defaultIncludes = [
        'permissions',
        'menus',
    ];

    /**
     * @param \App\Containers\Authorization\Models\Role $role
     *
     * @return array
     */
    public function transform(Role $role)
    {
        return [
            'object'       => 'Role',
            'id'           => $role->getHashedKey(), // << Unique Identifier
            'name'         => $role->name, // << Unique Identifier
            'description'  => $role->description,
            'display_name' => $role->display_name,
            'created_at'   => $role->created_at->toDateTimeString(),
            'updated_at'   => $role->updated_at->toDateTimeString(),
        ];
    }

    /**
     * @param \App\Containers\Authorization\Models\Role $role
     *
     * @return  \League\Fractal\Resource\Collection
     */
    public function includePermissions(Role $role)
    {
        return $this->collection($role->permissions, new PermissionTransformer());
    }

    public function includeMenus(Role $role)
    {
        return $this->collection($role->menus, new MenuTransformer());
    }

}
