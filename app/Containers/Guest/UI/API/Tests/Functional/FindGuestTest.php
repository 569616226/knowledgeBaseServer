<?php

namespace App\Containers\Guest\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindGuestTest extends TestCase
{

    protected $endpoint = 'get@v1/guests/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-guests',
    ];

    public function testFindGuest_()
    {

        // send the HTTP request
        $response = $this->injectId($this->guest->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->guest->open_id, $responseContent->data->open_id);
        $this->assertEquals($this->guest->name, $responseContent->data->name);
        $this->assertEquals($this->gender[$this->guest->gender], $responseContent->data->gender_txt);
        $this->assertEquals($this->guest_status[$this->guest->status], $responseContent->data->status_txt);
        $this->assertEquals($this->guest->avatar, $responseContent->data->avatar);
        $this->assertEquals($this->guest->like_linkas, $responseContent->data->like_linkas);
        $this->assertEquals($this->guest->viewed_linkas, $responseContent->data->viewed_linkas);

        $groups_ids = $this->guest->groups->pluck('id')->toArray();
        $groups_name = implode('、', $this->guest->groups->pluck('name')->toArray());

        $this->assertEquals($groups_name, $responseContent->data->groups_name);
        $this->assertEquals($groups_ids, $responseContent->data->groups_ids);
    }


    public function testFindGuestWithRelation_()
    {

        // send the HTTP request
        $response = $this->injectId($this->guest->id)->endpoint($this->endpoint . '?include=groups,navs')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertNotNull($responseContent->data->groups);
        $this->assertNotNull($responseContent->data->navs);
    }

}
