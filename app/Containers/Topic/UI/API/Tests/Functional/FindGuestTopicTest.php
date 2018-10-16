<?php

namespace App\Containers\Topic\UI\API\Tests\Functional;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Tests\TestCase;

/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindGuestTopicTest extends TestCase
{

    protected $endpoint = 'get@v1/linka_topics/{id}';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testFindGuestTopicWithRelation_()
    {

        $this->getTestingGuestWithoutAccess(['status' => 1]);

        // send the HTTP request
        $response = $this->injectId($this->topic->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->topic->title, $responseContent->data->title);
        $this->assertEquals($this->topic->describe, $responseContent->data->describe);
        $this->assertEquals($this->topic->price, $responseContent->data->price);
        $this->assertEquals($this->topic->ser_time, $responseContent->data->ser_time);
        $this->assertEquals($this->ser_type[$this->topic->ser_type], $responseContent->data->ser_type);
        $this->assertEquals($this->topic->need_infos, $responseContent->data->need_infos);
        $this->assertEquals($this->topic->remark, $responseContent->data->remark);
        $this->assertEquals($this->topic->guest->real_id, $responseContent->data->guest_id);
        $this->assertEquals(Apiato::call('Guest@FindGuestByIdTask', [$this->topic->guest_id])->real_name, $responseContent->data->guest_name);
        $this->assertEquals(Apiato::call('Guest@FindGuestByIdTask', [$this->topic->guest_id])->avatar, $responseContent->data->guest_avatar);
        $this->assertEquals(Apiato::call('Guest@FindGuestByIdTask', [$this->topic->guest_id])->office, $responseContent->data->guest_office);
        $this->assertEquals($this->topic_status[$this->topic->status], $responseContent->data->status);
        $this->assertEquals(2, $responseContent->data->appoint_appraises);
        $this->assertEquals(Apiato::call('Guest@FindGuestByIdTask', [$this->topic->guest_id])->city, $responseContent->data->guest_city);
        $this->assertEquals(Apiato::call('Guest@FindGuestByIdTask', [$this->topic->guest_id])->location, $responseContent->data->guest_location);

    }

}
