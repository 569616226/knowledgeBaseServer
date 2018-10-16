<?php

namespace App\Containers\Article\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;

/**
 * Class UpdateArticleTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class LikeArticleTest extends TestCase
{

    protected $endpoint = 'patch@v1/articles/{id}/like';

    protected $access = [
        'roles'       => null,
        'permissions' => null,
    ];

    public function testUpdateExistingArticle_()
    {
        $this->getTestingGuestWithoutAccess();

        $data = [
            'like'   => $this->faker->title,
        ];

        // send the HTTP request
        $response = $this->injectId($this->article->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned Article is the updated one
        $this->assertResponseContainKeyValue([
            'status'         => true,
            'msg'         => '操作成功',

        ]);
    }
}
