<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 13:53
 */

namespace App\Containers\Topic\UI\API\Tests\Functional;


use App\Containers\Tests\TestCase;

class ChangeTopicStatusTest extends TestCase
{
    protected $endpoint = 'post@v1/topics/{id}/change_status';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-aduit_topics',
    ];

    public function testChangeTopicStatusTo1_()
    {

        $data = [
            'status' => 1,
            'remark' => 'remark',
        ];

        // send the HTTP request
        $response = $this->injectId($this->topic->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->topic_status[$data['status']], $responseContent->data->status);
        $this->assertEquals($data['remark'], $responseContent->data->remark);

        if (env('SEND_WECHAT_TEMP_MSG')) {
            $msgs = $this->topic->guest->messages;
            $this->assertCount(1, $msgs);

            $content = '话题审核:恭喜您，您发布“' . $this->topic->title . '”话题，已经通过审核，现在您可以接受用户的预约了！！！';

            $this->assertEquals($content, $msgs->first()->content);
            $this->assertEquals('话题审核成功', $msgs->first()->title);
        }
    }

    public function testChangeTopicStatusTo0_()
    {

        $data = [
            'status' => 0,
            'remark' => 'remark',
        ];

        // send the HTTP request
        $response = $this->injectId($this->topic->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->topic_status[$data['status']], $responseContent->data->status);
        $this->assertEquals($data['remark'], $responseContent->data->remark);

        if (env('SEND_WECHAT_TEMP_MSG')) {
            $msgs = $this->topic->guest->messages;
            $this->assertCount(1, $msgs);

            $content = '话题审核:非常抱歉，您发布“' . $this->topic->title . '”话题，未能通过审核，建议检查话题内容后，再次提交申请！如有不便，尽请谅解！';

            $this->assertEquals($content, $msgs->first()->content);
            $this->assertEquals('话题审核失败', $msgs->first()->title);
        }

    }
}