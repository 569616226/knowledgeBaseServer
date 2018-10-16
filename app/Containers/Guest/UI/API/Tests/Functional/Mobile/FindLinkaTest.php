<?php

namespace App\Containers\Guest\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;

/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindLinkaTest extends TestCase
{

    protected $endpoint = 'get@v1/mobile_linkas/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function testFindMobileLinka_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->linka_1->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->linka_1->real_name, $responseContent->data->real_name);
        $this->assertEquals($this->linka_1->city, $responseContent->data->city);
        $this->assertEquals($this->linka_1->single_profile, $responseContent->data->single_profile);
        $this->assertEquals($this->linka_1->office, $responseContent->data->office);
        $this->assertEquals($this->linka_1->cover, $responseContent->data->cover);
        $this->assertEquals(3, $responseContent->data->helpers);
        $this->assertEquals(0, $responseContent->data->likes);
        $this->assertFalse($responseContent->data->is_like);
        $this->assertEquals($this->linka_1->location, $responseContent->data->location);
        $this->assertEquals(html_entity_decode(stripslashes($this->linka_1->profile)), $responseContent->data->profile);
    }

    public function testFindMobileLinkaWithRelation_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->linka_1->id)->endpoint($this->endpoint . '?include=answers,topics,articles')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertNotNull($responseContent->data->articles);
        $this->assertNotNull($responseContent->data->topics);
        $this->assertNotNull($responseContent->data->answers);
    }

}
