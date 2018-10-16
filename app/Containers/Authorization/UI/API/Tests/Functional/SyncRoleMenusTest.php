<?php

namespace App\Containers\Authorization\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Role;
use App\Containers\Menu\Models\Menu;
use App\Containers\Tests\TestCase;

/**
 * Class SyncRoleMenusTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class SyncRoleMenusTest extends TestCase
{

    protected $endpoint = 'post@v1/menus/role/sync';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-roles',
    ];

    public function testSyncMultipleMenusOnRole()
    {
        $menu1 = factory(Menu::class)->create();
        $menu2 = factory(Menu::class)->create();
        $role = factory(Role::class)->create();

        $data = [
            'menu_ids' => [
                $menu1->id,
                $menu2->id,
            ],
            'role_id'  => $role->id
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertTrue(count($responseContent->data->menus->data) > 1);

        $menuIds = array_pluck($responseContent->data->menus->data, 'id');

        $this->assertContains($menu1->getHashedKey(), $menuIds);
        $this->assertContains($menu2->getHashedKey(), $menuIds);

    }

}
