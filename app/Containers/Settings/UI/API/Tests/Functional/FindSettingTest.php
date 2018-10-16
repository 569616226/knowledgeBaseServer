<?php

namespace App\Containers\Settings\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindSettingTest extends TestCase
{

    protected $endpoint = 'get@v1/settings';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-settings',
    ];

    public function testFindOrderSetting_()
    {

        // send the HTTP request
        $data = ['key' => 'system_order_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }

    public function testFindFinanceSetting_()
    {

        // send the HTTP request
        $data = ['key' => 'system_finance_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }


    public function testFindTakeSetting_()
    {
        // send the HTTP request
        $data = ['key' => 'system_take_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }

    public function testFindWechatSetting_()
    {
        // send the HTTP request
        $data = ['key' => 'system_wehchat_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }

    public function testFindAnswerPriceSetting_()
    {
        // send the HTTP request
        $data = ['key' => 'system_answer_price_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }

    public function testFindLinkaIndexTopSetting_()
    {
        // send the HTTP request
        $data = ['key' => 'system_linka_index_top_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }

    public function testFindTopicIndexTopSetting_()
    {
        // send the HTTP request
        $data = ['key' => 'system_topic_index_top_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }


}
