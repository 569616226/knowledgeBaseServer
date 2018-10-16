<?php

namespace App\Containers\Guest\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindLinkaTest extends TestCase
{

    protected $endpoint = 'get@v1/linkas/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-guests',
    ];

    public function testFindLinka_()
    {

        // send the HTTP request
        $response = $this->injectId($this->linka_1->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->linka_1->open_id, $responseContent->data->open_id);
        $this->assertEquals($this->linka_1->name, $responseContent->data->name);
        $this->assertEquals($this->linka_1->real_name, $responseContent->data->real_name);
        $this->assertEquals($this->linka_1->avatar, $responseContent->data->avatar);
        $this->assertEquals($this->linka_1->phone, $responseContent->data->phone);
        $this->assertEquals($this->linka_1->email, $responseContent->data->email);
        $this->assertEquals($this->linka_1->we_name, $responseContent->data->we_name);
        $this->assertEquals($this->linka_1->city, $responseContent->data->city);
        $this->assertEquals($this->linka_1->single_profile, $responseContent->data->single_profile);
        $this->assertEquals($this->linka_1->office, $responseContent->data->office);
        $this->assertEquals($this->linka_1->cover, $responseContent->data->cover);
        $this->assertEquals($this->linka_1->location, $responseContent->data->location);
        $this->assertEquals($this->linka_1->card_id, $responseContent->data->card_id);
        $this->assertEquals($this->linka_1->card_pic, $responseContent->data->card_pic);
        $this->assertEquals($this->linka_1->referee, $responseContent->data->referee);
        $this->assertEquals($this->linka_1->remark, $responseContent->data->remark);
        $this->assertEquals(html_entity_decode(stripslashes($this->linka_1->profile)), $responseContent->data->profile);
        $this->assertEquals($this->linka_1->status, $responseContent->data->status);
        $this->assertEquals($this->linka_1->gender, $responseContent->data->gender);

        $groups_ids = $this->linka_1->groups->pluck('id')->toArray();
        $groups_name = implode('、', $this->linka_1->groups->pluck('name')->toArray());
        $navs_name = implode('、', $this->linka_1->navs->pluck('name')->toArray());
        $this->assertEquals($groups_name, $responseContent->data->groups_name);
        $this->assertEquals($groups_ids, $responseContent->data->groups_ids);
        $this->assertEquals($navs_name, $responseContent->data->navs_name);
    }


    public function testFindLinkaWithRelation_()
    {

        // send the HTTP request
        $response = $this->injectId($this->linka_1->id)->endpoint($this->endpoint . '?include=groups,navs')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertNotNull($responseContent->data->groups);
        $this->assertNotNull($responseContent->data->navs);
    }

}
