<?php

namespace App\Containers\Authorization\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class SyncRoleMenusAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'menu_ids',
            'role_id',
        ]);

        $role = Apiato::call('Authorization@FindRoleTask', [$data['role_id']]);

        $role->menus()->sync($data['menu_ids']);

        return $role;
    }
}
