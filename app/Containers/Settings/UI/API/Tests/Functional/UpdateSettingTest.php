<?php

namespace App\Containers\Settings\UI\API\Tests\Functional;


use App\Containers\Tests\TestCase;

/**
 * Class UpdateSettingTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateSettingTest extends TestCase
{

    protected $endpoint = 'patch@v1/settings';
    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-settings',
    ];

    public function testUpdateOrderSetting_()
    {

        // send the HTTP request
        $data = [
            'key'   => 'system_order_settings',
            'value' => [0, 0, 0],
        ];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);
        $this->assertEquals($data['value'], $responseContent->data->value);

    }

    public function testUpdateFinanceSetting_()
    {

        // send the HTTP request
        $data = [
            'key'   => 'system_finance_settings',
            'value' => [0, 0]
        ];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);
        $this->assertEquals($data['value'], $responseContent->data->value);

    }


    public function testUpdateTakeSetting_()
    {

        // send the HTTP request
        $data = [
            'key'   => 'system_take_settings',
            'value' => [[1, 2], [1, 2], [1, 2, 3],1]
        ];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);
        $this->assertEquals($data['value'], $responseContent->data->value);

    }

    public function testUpdateWechatSetting_()
    {

        // send the HTTP request
        $data = [
            'key'   => 'system_wehchat_settings',
            'value' => ['更新关注回复设置：欢迎来到链咖问答系统']
        ];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);
        $this->assertEquals($data['value'], $responseContent->data->value);

    }

    public function testUpdateAnswerPriceSetting_()
    {

        // send the HTTP request
        $data = [
            'key'   => 'system_answer_price_settings',
            'value' => [20, 20]
        ];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);
        $this->assertEquals($data['value'], $responseContent->data->value);

    }

    public function testUpdateLinkaIndexTopSetting_()
    {

        // send the HTTP request
        $data = [
            'key'   => 'system_linka_index_top_settings',
            'value' => [0, [1,2,3]]
        ];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);
        $this->assertEquals($data['value'], $responseContent->data->value);

    }
    public function testUpdateTopicIndexTopSetting_()
    {

        // send the HTTP request
        $data = [
            'key'   => 'system_topic_index_top_settings',
            'value' => [1, [1,2,3]]
        ];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);
        $this->assertEquals($data['value'], $responseContent->data->value);

    }

}
