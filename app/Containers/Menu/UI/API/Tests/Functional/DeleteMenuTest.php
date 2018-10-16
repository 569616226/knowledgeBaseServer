<?php

namespace App\Containers\Menu\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class DeleteUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteMenuTest extends TestCase
{

    protected $endpoint = 'delete@v1/menus/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-menus',
    ];

    public function testDeleteExistingMenu_()
    {

        // send the HTTP request
        $response = $this->injectId($this->menu->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(202);

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => "操作成功",
        ]);
    }

    public function testDeleteAnotherExistingMenu_()
    {
        // make the call form the user token who has no access
        $this->getTestingUserWithoutAccess();

        // send the HTTP request
        $response = $this->injectId($this->menu->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(403);
    }
}
