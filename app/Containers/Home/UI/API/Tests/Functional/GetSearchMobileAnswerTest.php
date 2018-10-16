<?php

namespace App\Containers\Home\UI\API\Tests\Functional;

use App\Containers\Answer\Models\Answer;
use App\Containers\Question\Models\Question;
use App\Containers\Tests\TestCase;

/**
 * Class GetAllHomesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetSearchMobileAnswerTest extends TestCase
{

    protected $endpoint = 'post@v1/homes/search_answer';

    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testSearchAnswerHomeDatas_()
    {
        $this->getTestingGuestWithoutAccess();

        $answer = factory(Answer::class)->create(['name'=>'搜查测试问题1']);
        $answer1 = factory(Answer::class)->create(['name'=>'搜查测试问题2']);

        factory(Question::class)->create(['answer_id'=>$answer->id]);
        factory(Question::class)->create(['answer_id'=>$answer1->id]);

        $data = [
            'search_text' => '搜查测试',
        ];
        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertCount(2,$responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)

    }

}
