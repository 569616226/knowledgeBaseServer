<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/7
 * Time: 11:53
 */

namespace App\Containers\Answer\UI\API\Tests\Functional\Mobile;


use App\Containers\Tests\TestCase;

class GetAllGuestAnswerTest extends TestCase
{
    protected $endpoint = 'get@v1/guest_answers';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];


    public function testGetAllGuestAnswers_()
    {
        $guest = $this->getTestingGuestWithoutAccess();

        $guest->my_answers()->attach([$this->answer->id => ['is_creator' => 1]]);

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $guest_answer_counts = $guest->my_answers->count();
        // assert the returned data size is correct
        $this->assertCount($guest_answer_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }
}