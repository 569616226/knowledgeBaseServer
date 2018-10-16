<?php

namespace App\Containers\Topic\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;
use App\Containers\Topic\Models\Topic;

/**
 * Class GetAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllTopicTest extends TestCase
{

    protected $endpoint = 'get@v1/topics';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-appoints',
    ];

    public function testGetAllTopics_()
    {

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $topic_counts = Topic::all()->count();
        // assert the returned data size is correct
        $this->assertCount($topic_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }


}
