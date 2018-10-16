<?php

namespace App\Containers\Comment\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateCommentTest extends TestCase
{

    protected $endpoint = 'post@v1/article/{id}/comments';

    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCreateComment_()
    {
        $guest = $this->getTestingGuestWithoutAccess();
        $data = [
            'content' => 'test_comment',
        ];

        // send the HTTP request
        $response = $this->injectId($this->article->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => '操作成功',
        ]);


        // assert the data is stored in the database
        $this->assertDatabaseHas('comments', [
            'content'    => $data['content'],
            'guest_id'   => $guest->id,
            'article_id' => $this->article->id,
        ]);

    }

}
