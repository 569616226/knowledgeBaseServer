<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 13:53
 */

namespace App\Containers\Article\UI\API\Tests\Functional;


use App\Containers\Tests\TestCase;

class ChangeArticleStatusTest extends TestCase
{
    protected $endpoint = 'post@v1/articles/{id}/change_status';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-aduit_arcticles',
    ];

    public function testChangeArticleStatusTo1_()
    {
        $data = [
            'status' => 1,
            'remark' => 'remark',
        ];

        // send the HTTP request
        $response = $this->injectId($this->article->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($this->topic_status[$data['status']], $responseContent->data->status);
        $this->assertEquals($data['remark'], $responseContent->data->remark);

        if (env('SEND_WECHAT_TEMP_MSG')) {
            $msgs = $this->article->guest->messages;
            $this->assertCount(1, $msgs);

            $content = '文章审核:您发表的“' . $this->article->title . '” 文章，已经通过人工审核，感谢您的投稿！';

            $this->assertEquals($content, $msgs->first()->content);
            $this->assertEquals('文章审核成功', $msgs->first()->title);
        }

    }

    public function testChangeArticleStatusTo0_()
    {
        $data = [
            'status' => 0,
            'remark' => 'remark',
        ];

        // send the HTTP request
        $response = $this->injectId($this->article->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->topic_status[$data['status']], $responseContent->data->status);

        if (env('SEND_WECHAT_TEMP_MSG')) {
            $msgs = $this->article->guest->messages;
            $this->assertCount(1, $msgs);

            $content = '文章审核:非常抱歉，您发表的“' . $this->article->title . '”文章，未能通过审核，建议检查文章内容后，再次提交申请！如有不便，尽请谅解！';

            $this->assertEquals($content, $msgs->first()->content);
            $this->assertEquals('文章审核失败', $msgs->first()->title);
        }
    }
}