<?php

namespace App\Containers\Group\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

class GroupSeeder extends Seeder
{
    public function run()
    {
        Apiato::call('Group@CreateGroupTask', [
            [
                'name'    => '普通用户',
                'user_id' => Apiato::call('User@FindUserByEmailTask', ['admin@admin.com'])->id,
            ]
        ]);

        Apiato::call('Group@CreateGroupTask', [
            [
                'name'    => '活跃会员',
                'user_id' => Apiato::call('User@FindUserByEmailTask', ['admin@admin.com'])->id,
            ]
        ]);

        Apiato::call('Group@CreateGroupTask', [
            [
                'name'    => '高级大咖',
                'user_id' => Apiato::call('User@FindUserByEmailTask', ['admin@admin.com'])->id,
            ]
        ]);

        Apiato::call('Group@CreateGroupTask', [
            [
                'user_id' => Apiato::call('User@FindUserByEmailTask', ['admin@admin.com'])->id,
                'name'    => '报关通关',
            ]
        ]);

        Apiato::call('Group@CreateGroupTask', [
            [
                'name'    => '推广营销',
                'user_id' => Apiato::call('User@FindUserByEmailTask', ['admin@admin.com'])->id,
            ]
        ]);

    }
}
