<?php

namespace App\Containers\Menu\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class GetAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetUserMenusTest extends TestCase
{

    protected $endpoint = 'get@v1/menus';


    public function testGetUserMenus_()
    {

        $user = $this->getTestingUser();
        $user->assignRole('admin');

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $menu_counts = $user->menus->count();
        // assert the returned data size is correct
        $this->assertCount($menu_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }


}
