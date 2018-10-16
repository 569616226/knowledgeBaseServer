<?php

namespace App\Containers\User\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class UserPermissionsSeeder_1
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class UserPermissionsSeeder_1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Permissions ----------------------------------------------------------
        Apiato::call('Authorization@CreatePermissionTask', ['search-users', '搜索管理员权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['list-users', '管理员列表权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['update-users', '更新管理员权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['delete-users', '删除管理员权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['refresh-users', '重置管理员权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['frozen-users', '冻结/解冻管理员权限']);

        // ...

    }
}
