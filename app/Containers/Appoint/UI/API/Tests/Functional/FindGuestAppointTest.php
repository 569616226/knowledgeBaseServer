<?php

namespace App\Containers\Appoint\UI\API\Tests\Functional;

use App\Containers\Appoint\Models\Appoint;
use App\Containers\Tests\TestCase;

/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindGuestAppointTest extends TestCase
{

    protected $endpoint = 'get@v1/linka_appoints/{id}';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testFindGuestAppoint_()
    {

        $this->getTestingGuestWithoutAccess(['status' => 1]);

        // send the HTTP request
        $response = $this->injectId($this->appoint->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->status[$this->appoint->status], $responseContent->data->status);
        $this->assertEquals($this->appoint->cancel_res, $responseContent->data->cancel_res);
        $this->assertEquals($this->appoint->canceler, $responseContent->data->canceler);
        $this->assertEquals($this->appoint->answers, $responseContent->data->answers);
        $this->assertEquals($this->appoint->profile, $responseContent->data->profile);
        $this->assertEquals($this->guest->name, $responseContent->data->guest_name);
        $this->assertEquals($this->guest->phone, $responseContent->data->guest_phone);
        $this->assertEquals($this->guest->id, $responseContent->data->guest_id);
        $this->assertEquals($this->appoint->topic->guest->id, $responseContent->data->linka_id);
        $this->assertEquals($this->ser_type[$this->appoint->topic->ser_type], $responseContent->data->ser_type);
    }

    public function testFindGuestAppointWithRelation_()
    {

        $this->getTestingGuestWithoutAccess(['status' => 1]);

        // send the HTTP request
        $response = $this->injectId($this->appoint->id)->endpoint($this->endpoint . '?include=topic')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->appoint->cancel_res, $responseContent->data->cancel_res);
        $this->assertEquals($this->appoint->canceler, $responseContent->data->canceler);
        $this->assertEquals($this->appoint->answers, $responseContent->data->answers);
        $this->assertEquals($this->appoint->profile, $responseContent->data->profile);
        $this->assertEquals($this->guest->name, $responseContent->data->guest_name);
        $this->assertNotNull($responseContent->data->topic);
    }

    public function testFindAppointWithRelationNoData_()
    {
        $this->getTestingGuestWithoutAccess();
        $appoint = factory(Appoint::class)->create(
            [
                'cancel_res' => null,
                'canceler'   => null,
                'answers'    => [0,1,2],
                'profile'    => '学员自我介绍',
                'status'     => 1,
                'guest_id'   => $this->guest->id,
                'topic_id'   => $this->topic->id,
                'created_at' => now()->addMinute(12)
            ]
        );

        // send the HTTP request
        $response = $this->injectId($appoint->id)->endpoint($this->endpoint . '?include=topic')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->appoint->cancel_res, $responseContent->data->cancel_res);
        $this->assertEquals($this->appoint->canceler, $responseContent->data->canceler);
        $this->assertEquals($this->appoint->answers, $responseContent->data->answers);
        $this->assertEquals($this->appoint->profile, $responseContent->data->profile);
        $this->assertEquals($this->guest->name, $responseContent->data->guest_name);
        $this->assertNotNull($responseContent->data->topic);
    }

}
