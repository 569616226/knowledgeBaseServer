<?php

namespace App\Containers\Group\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class DeleteUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteGroupTest extends TestCase
{

    protected $endpoint = 'delete@v1/groups/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-groups',
    ];

    public function testDeleteExistingGroup_()
    {

        // send the HTTP request
        $response = $this->injectId($this->group->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => "操作成功",
        ]);
    }

    public function testDeleteAnotherExistingGroup_()
    {
        // make the call form the user token who has no access
        $this->getTestingUserWithoutAccess();

        // send the HTTP request
        $response = $this->injectId($this->anotherGroup->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(403);
    }
}
