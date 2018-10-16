<?php

namespace App\Containers\Answer\UI\API\Tests\Functional;

use App\Containers\Answer\Models\Answer;
use App\Containers\Tests\TestCase;

/**
 * Class GetAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllAnswerTest extends TestCase
{

    protected $endpoint = 'get@v1/answers';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-answers',
    ];

    public function testGetAllAnswers_()
    {

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $answer_counts = Answer::all()->count();
        // assert the returned data size is correct
        $this->assertCount($answer_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }

}
