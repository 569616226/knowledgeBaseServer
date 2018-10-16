<?php

namespace App\Containers\Answer\UI\API\Tests\Functional\Mobile;

use App\Containers\Answer\Models\Answer;
use App\Containers\Question\Models\Question;
use App\Containers\Tests\TestCase;


/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindGuestAnswerTest extends TestCase
{

    protected $endpoint = 'get@v1/guest_answers/{id}';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testFindCreatorGuestAnswer_()
    {
        $guest = $this->getTestingGuestWithoutAccess();
        $answer = factory(Answer::class)->create(['status' => 1]);
        $guest->read_answers()->attach([
            $answer->id => ['is_reader' => 1],
        ]);

        $this->guest->my_answers()->attach([
            $answer->id => ['is_creator' => 1],
        ]);

        $question = factory(Question::class)->create([
            'answer_id' => $answer->id,
            'guest_id' => $this->linka_1->id,
        ]);
        // send the HTTP request
        $response = $this->injectId($answer->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeys(['linka_hash_id']);

        $responseContent = $this->getResponseContentObject();

        $answer_display_time = get_ansewr_order_cancel_time();//问答订单自动关闭时间

        $time = now();
        $diffInHours = $time->diffInHours($answer->created_at->addHours($answer_display_time));
        $diffInMinutes =$time->diffInMinutes($answer->created_at->addHours($answer_display_time))- $diffInHours * 60;
        $display_time = $diffInHours . '小时' . $diffInMinutes  . '分钟';

        $this->assertEquals($answer->name, $responseContent->data->name);
        $this->assertEquals($answer->price, $responseContent->data->price);
        $this->assertEquals($answer->star, $responseContent->data->star);
        $this->assertEquals($this->answer_status[$answer->status], $responseContent->data->status);
        $this->assertEquals($this->linka_1->real_name, $responseContent->data->linka_name);
        $this->assertEquals($this->linka_1->avatar, $responseContent->data->linka_avatar);
        $this->assertEquals($this->linka_1->office, $responseContent->data->linka_office);
        $this->assertEquals($this->linka_1->id, $responseContent->data->linka_id);
        $this->assertEquals($question->content, $responseContent->data->content);
        $this->assertEquals($display_time, $responseContent->data->display_time);
        $this->assertFalse($responseContent->data->is_guest);
        $this->assertNotNull($responseContent->data->readers);
    }

    public function testFindReaderGuestAnswer_()
    {
        $guest = $this->getTestingGuestWithoutAccess();
        $answer = factory(Answer::class)->create(['status' => 1]);
        $guest->my_answers()->attach([
            $answer->id => ['is_reader' => 1],
        ]);

        $this->guest->my_answers()->attach([
            $answer->id => ['is_creator' => 1],
        ]);

        $question = factory(Question::class)->create([
            'answer_id' => $answer->id,
            'guest_id' => $this->linka_1->id,
        ]);
        // send the HTTP request
        $response = $this->injectId($answer->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeys(['linka_hash_id']);

        $responseContent = $this->getResponseContentObject();

        $answer_display_time = get_ansewr_order_cancel_time();//问答订单自动关闭时间
        $time = now();
        $diffInHours = $time->diffInHours($answer->created_at->addHours($answer_display_time));
        $diffInMinutes =$time->diffInMinutes($answer->created_at->addHours($answer_display_time))- $diffInHours * 60;
        $display_time = $diffInHours . '小时' . $diffInMinutes  . '分钟';

        $this->assertEquals($answer->name, $responseContent->data->name);
        $this->assertEquals($answer->price, $responseContent->data->price);
        $this->assertEquals($answer->star, $responseContent->data->star);
        $this->assertEquals($this->answer_status[$answer->status], $responseContent->data->status);
        $this->assertEquals($this->linka_1->real_name, $responseContent->data->linka_name);
        $this->assertEquals($this->linka_1->avatar, $responseContent->data->linka_avatar);
        $this->assertEquals($this->linka_1->office, $responseContent->data->linka_office);
        $this->assertEquals($this->linka_1->id, $responseContent->data->linka_id);
        $this->assertEquals($question->content, $responseContent->data->content);
        $this->assertEquals($display_time, $responseContent->data->display_time);
        $this->assertNotNull($responseContent->data->readers);

    }

}
