<?php

namespace App\Containers\Article\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;

/**
 * Class DeleteUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteArticleTest extends TestCase
{

    protected $endpoint = 'delete@v1/articles/{id}';

    protected $access = [
        'roles'       => null,
        'permissions' => null,
    ];

    public function testDeleteExistingArticle_()
    {

        $this->getTestingGuestWithoutAccess();

        // send the HTTP request
        $response = $this->injectId($this->article->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => "操作成功",
        ]);
    }

}
