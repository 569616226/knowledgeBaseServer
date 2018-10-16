<?php

namespace App\Containers\Article\UI\API\Tests\Functional\Mobile;


use App\Containers\Tests\TestCase;

/**
 * Class GetAllArticlesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllArticlesTest extends TestCase
{

    protected $endpoint = 'get@v1/articles/mobile/list';

    protected $access = [
        'roles'       => null,
        'permissions' => null,
    ];

    public function testGetGuestArticles_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $article_counts = auth_user()->articles()->paginate()->count();
        // assert the returned data size is correct
        $this->assertCount($article_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)

    }


}
