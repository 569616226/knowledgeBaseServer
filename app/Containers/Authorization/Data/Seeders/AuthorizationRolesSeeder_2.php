<?php

namespace App\Containers\Authorization\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class AuthorizationRolesSeeder_2
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationRolesSeeder_2 extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Roles ----------------------------------------------------------------
        Apiato::call('Authorization@CreateRoleTask', ['admin', '系统管理员', '系统管理员角色', 999]);
        Apiato::call('Authorization@CreateRoleTask', ['finace', '财务', '财务管理角色', 999]);

        // ...

    }
}
