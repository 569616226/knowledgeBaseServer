<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/7
 * Time: 11:53
 */

namespace App\Containers\Answer\UI\API\Tests\Functional\Mobile;

use App\Containers\Question\Models\Question;
use App\Containers\Tests\TestCase;

class GetLinkaAnswersTest extends TestCase
{
    protected $endpoint = 'get@v1/linka_answers';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testGetLinkaAnswers_()
    {
        $guest = $this->getTestingGuestWithoutAccess(['status' => 1]);

        factory(Question::class)->create([
            'guest_id'  => $guest->id,
            'answer_id' => $this->answer->id,
        ]);

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $linka_no_quetion_answer_counts = auth_user()->linka_no_question_answers->count();
        // assert the returned data size is correct
        $this->assertFalse(in_array('已回答', array_pluck($responseContent->data, 'status')));
        $this->assertFalse(in_array('已关闭', array_pluck($responseContent->data, 'status')));
        $this->assertCount($linka_no_quetion_answer_counts, $responseContent->data);
    }
}