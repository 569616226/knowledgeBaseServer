<?php

namespace App\Containers\Question\UI\API\Tests\Functional;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Answer\Models\Answer;
use App\Containers\Order\Models\Order;
use App\Containers\Question\Models\Question;
use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateQuestionTest extends TestCase
{

    protected $endpoint = 'patch@v1/questions/{id}';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testUpdateQuestion_()
    {
        $guest = $this->getTestingGuestWithoutAccess(['status' => 1]);

        $data = [
            'content' => '回答内容。。。。。。。。。',
        ];

        $price = get_create_answer_price();

        $answer = factory(Answer::class)->create(['status' => 2]);
        $this->guest->answers()->attach([$answer->id => ['is_creator' => 1]]);
        factory(Order::class)->create([
            'answer_id'   => $answer->id,
            'status'         => 2,
            'answer_type'    => 0,
            'price' => $price
        ]);

        $question = factory(Question::class)->create([
            'answer_id' => $answer->id,
            'guest_id'  => $guest->id,
        ]);

        // send the HTTP request
        $response = $this->injectId($answer->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert response contain the token
        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => '操作成功'
        ]);

        /*获取修改后的数据*/
        $re_answer = Apiato::call('Answer@FindAnswerByIdTask',[$answer->id]);
        $re_question = Question::find($question->id);

        $this->assertEquals(1,$re_answer->status);
        $this->assertEquals($data['content'],$re_question->content);

        /*
        //设置为1小时后完成问答，生成交易记录
        $this->assertCount(1,$guest->finaces);

        //提成现金
        $system_take_settings = get_setting('system_take_settings')[1];//回答问题提成比例

        $wallets = $system_take_settings[1] * $price / 100;
        $this->assertEquals($wallets,$guest->wallets);*/

        if (env('SEND_WECHAT_TEMP_MSG')) {

            $msgs = $this->guest->messages;
            $this->assertCount(1, $msgs);

            $content = '问题:' . $re_answer->name;

            $this->assertEquals($content, $msgs->first()->content);

            $this->assertEquals('大咖已回答您的提问，快去查看打分吧！', $msgs->first()->title);

        }

    }

}
