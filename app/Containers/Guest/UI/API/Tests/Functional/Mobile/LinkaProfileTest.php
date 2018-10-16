<?php

namespace App\Containers\Guest\UI\API\Tests\Functional\Mobile;


use App\Containers\Tests\TestCase;

/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class LinkaProfileTest extends TestCase
{

    protected $endpoint = 'get@v1/linka_profile';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testFindLinkaProfile_()
    {
        $guest = $this->getTestingGuestWithoutAccess(['status' => 1]);

        // send the HTTP request
        $response = $this->injectId($guest->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($guest->open_id, $responseContent->data->open_id);
        $this->assertEquals($guest->name, $responseContent->data->name);
        $this->assertEquals($guest->real_name, $responseContent->data->real_name);
        $this->assertEquals($guest->avatar, $responseContent->data->avatar);
        $this->assertEquals($guest->phone, $responseContent->data->phone);
        $this->assertEquals($guest->email, $responseContent->data->email);
        $this->assertEquals($guest->we_name, $responseContent->data->we_name);
        $this->assertEquals($guest->city, $responseContent->data->city);
        $this->assertEquals($guest->single_profile, $responseContent->data->single_profile);
        $this->assertEquals($guest->office, $responseContent->data->office);
        $this->assertEquals($guest->cover, $responseContent->data->cover);
        $this->assertEquals($guest->location, $responseContent->data->location);
        $this->assertEquals($guest->card_id, $responseContent->data->card_id);
        $this->assertEquals($guest->card_pic, $responseContent->data->card_pic);
        $this->assertEquals($guest->referee, $responseContent->data->referee);
        $this->assertEquals($guest->remark, $responseContent->data->remark);
        $this->assertEquals(html_entity_decode(stripslashes($guest->profile)), $responseContent->data->profile);
        $this->assertEquals($guest->status, $responseContent->data->status);
        $this->assertEquals($guest->gender, $responseContent->data->gender);
    }


    public function testFindLinkaProfileWithRelation_()
    {
        $guest = $this->getTestingGuestWithoutAccess(['status' => 1]);

        // send the HTTP request
        $response = $this->injectId($guest->id)->endpoint($this->endpoint . '?include=topics,articles')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertNotNull($responseContent->data->topics);
        $this->assertNotNull($responseContent->data->articles);
    }

}
