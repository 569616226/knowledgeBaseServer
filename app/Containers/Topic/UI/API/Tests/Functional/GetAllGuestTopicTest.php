<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/7
 * Time: 11:53
 */

namespace App\Containers\Topic\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;


class GetAllGuestTopicTest extends TestCase
{
    protected $endpoint = 'get@v1/linka_topics';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];


    public function testGetAllAppoints_()
    {
        $guest = $this->getTestingGuestWithoutAccess(['status' => 1]);

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $guest_topic_counts = $guest->topics->count();
        // assert the returned data size is correct
        $this->assertCount($guest_topic_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }
}