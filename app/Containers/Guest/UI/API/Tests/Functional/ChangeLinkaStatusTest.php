<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 13:53
 */

namespace App\Containers\Guest\UI\API\Tests\Functional;


use App\Containers\Tests\TestCase;

class ChangeLinkaStatusTest extends TestCase
{
    protected $endpoint = 'post@v1/linkas/{id}/change_status';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-aduit_linkas',
    ];

    public function testChangeLinkasStatusTo1_()
    {
        $user = $this->getTestingUser();
        $data = [
            'status' => 1,
            'remark' => 'remark',
        ];

        // send the HTTP request
        $response = $this->injectId($this->linka_2->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();
        $this->assertEquals($data['status'], $responseContent->data->status);
        $this->assertEquals($data['remark'], $responseContent->data->remark);
        $this->assertNotNull($responseContent->data->audit_time);
        $this->assertEquals($user->name, $responseContent->data->auditor);

        if (env('SEND_WECHAT_TEMP_MSG')) {
            $msgs = $this->linka_2->messages;
            $this->assertCount(1, $msgs);

            $content = '大咖审核:' . config('guest-container.linka_wechat_temp_content_success');

            $this->assertEquals($content, $msgs->first()->content);
            $this->assertEquals('大咖审核成功', $msgs->first()->title);
        }

    }

    public function testChangeLinkasStatusTo0_()
    {
        $user = $this->getTestingUser();

        $data = [
            'status' => 0,
            'remark' => 'remark',
        ];

        // send the HTTP request
        $response = $this->injectId($this->linka_2->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['status'], $responseContent->data->status);
        $this->assertEquals($data['remark'], $responseContent->data->remark);
        $this->assertNotNull($responseContent->data->audit_time);
        $this->assertEquals($user->name, $responseContent->data->auditor);

        if (env('SEND_WECHAT_TEMP_MSG')) {
            $msgs = $this->linka_2->messages;
            $this->assertCount(1, $msgs);

            $content = '大咖审核:' . config('guest-container.linka_wechat_temp_content_fail');

            $this->assertEquals($content, $msgs->first()->content);
            $this->assertEquals('大咖审核失败', $msgs->first()->title);
        }

    }
}