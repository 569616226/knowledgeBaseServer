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

class GetLinkaHasQuestionAnswersTest extends TestCase
{
    protected $endpoint = 'get@v1/linka_has_question_answers';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testGetLinkaHasQuestionAnswers_()
    {
        $guest = $this->getTestingGuestWithoutAccess(['status' => 1]);

        factory(Question::class)->create([
            'guest_id'  => $guest->id,
            'answer_id' => $this->answer_1->id,
            'content'   => 'content'
        ]);

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $linka_has_quetion_answer_counts = auth_user()->linka_has_question_answers->count();
        $this->assertFalse(in_array('待回答', array_pluck($responseContent->data, 'status')));
        // assert the returned data size is correct
        $this->assertCount($linka_has_quetion_answer_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }
}