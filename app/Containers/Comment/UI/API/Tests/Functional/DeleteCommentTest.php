<?php

namespace App\Containers\Comment\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class DeleteUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteCommentTest extends TestCase
{

    protected $endpoint = 'delete@v1/comments/{id}';

    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testDeleteExistingComment_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->comment->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => "操作成功",
        ]);
    }

}
