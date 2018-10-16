<?php

namespace App\Containers\Menu\UI\API\Tests\Functional;

use App\Containers\Menu\Models\Menu;
use App\Containers\Tests\TestCase;

/**
 * Class GetAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllMenusTest extends TestCase
{

    protected $endpoint = 'get@v1/menus';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testGetAllMenus_()
    {

        $user = $this->getTestingUser();
        $user->assignRole('admin');

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $menu_counts = Menu::where('parent_id', 0)->get()->count();
        // assert the returned data size is correct
        $this->assertCount($menu_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }


}
