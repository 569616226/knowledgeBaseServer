<?php

namespace App\Containers\Home\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;
use App\Containers\Topic\Models\Topic;


/**
 * Class GetAllHomesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetSearchMobileTopicTest extends TestCase
{

    protected $endpoint = 'post@v1/homes/search_topic';

    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testSearchTopicHomeDatas_()
    {
        $this->getTestingGuestWithoutAccess();

        factory(Topic::class)->create(['title'=>'搜查测试话题']);
        factory(Topic::class)->create(['title'=>'搜查测试话题111']);

        $data = [
            'search_text' => '搜查测试',
        ];
        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertCount(2,$responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)

    }

}
