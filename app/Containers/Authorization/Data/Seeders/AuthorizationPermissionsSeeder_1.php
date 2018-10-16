<?php

namespace App\Containers\Authorization\Data\Seeders;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Seeders\Seeder;

/**
 * Class AuthorizationPermissionsSeeder_1
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class AuthorizationPermissionsSeeder_1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Permissions ----------------------------------------------------------
        Apiato::call('Authorization@CreatePermissionTask', ['manage-roles', '新建, 更新, 删除, 获取, 增减角色权限和获取所有权限的权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['create-admins', '创建管理员账号权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-admins-access', '账号角色操作权限']);

        Apiato::call('Authorization@CreatePermissionTask', ['manage-settings', '系统基本设置权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-menus', '系统菜單权限']);

//        Apiato::call('Authorization@CreatePermissionTask', ['access-dashboard', '首页权限']);

        Apiato::call('Authorization@CreatePermissionTask', ['manage-aduit_linkas', '大咖审核权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-aduit_topics', '话题审核权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-aduit_arcticles', '文章审核权限']);

        Apiato::call('Authorization@CreatePermissionTask', ['manage-answers', '问答管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-appoints', '约见管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-articles', '文章管理权限']);

        Apiato::call('Authorization@CreatePermissionTask', ['manage-navs', '分类管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-messages', '系统消息管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-wechats', '公众号管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-adverts', '首页内容管理权限']);

        Apiato::call('Authorization@CreatePermissionTask', ['manage-groups', '用户组管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-guests', '用户管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-linkas', '大咖管理权限']);

        Apiato::call('Authorization@CreatePermissionTask', ['manage-appoint_orders', '约见订单管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-answer_orders', '问答订单管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-cancel_orders', '违约金订单管理权限']);

        Apiato::call('Authorization@CreatePermissionTask', ['manage-finaces', '交易记录管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-finace_cases', '提现审核管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-finace_refunds', '退款管理权限']);
        Apiato::call('Authorization@CreatePermissionTask', ['manage-finace_aduit', '提/退款审核权限']);

        // ...
    }
}
