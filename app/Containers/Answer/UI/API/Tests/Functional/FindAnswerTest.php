<?php

namespace App\Containers\Answer\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;


/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindAnswerTest extends TestCase
{

    protected $endpoint = 'get@v1/answers/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-answers',
    ];

    public function testFindAnswerWithRelation_()
    {

        // send the HTTP request
        $response = $this->injectId($this->answer->id)->endpoint($this->endpoint . '?include=question')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->answer->name, $responseContent->data->name);
        $this->assertEquals($this->answer->price, $responseContent->data->price);
        $this->assertEquals($this->answer_status[$this->answer->status], $responseContent->data->status);
        $this->assertEquals($this->answer->question->guest->real_name, $responseContent->data->answer_name);
        $this->assertEquals($this->answer->question->guest->office, $responseContent->data->answer_office);
        $this->assertEquals($this->answer->question->guest->avatar, $responseContent->data->answer_avatar);

        $this->assertNotNull($responseContent->data->question);
    }


}
