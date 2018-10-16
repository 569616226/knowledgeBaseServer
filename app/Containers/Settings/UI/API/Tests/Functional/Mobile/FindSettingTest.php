<?php

namespace App\Containers\Settings\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;

/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindSettingTest extends TestCase
{

    protected $endpoint = 'get@v1/mobile/settings';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function testMobileFindOrderSetting_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $data = ['key' => 'system_order_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }

    public function testMobileFindFinanceSetting_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $data = ['key' => 'system_finance_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }


    public function testMobileFindTakeSetting_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $data = ['key' => 'system_take_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }

    public function testMobileFindWechatSetting_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $data = ['key' => 'system_wehchat_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }

    public function testMobileFindAnswerPriceSetting_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $data = ['key' => 'system_answer_price_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }

    public function testMobileFindLinkaIndexTopSetting_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $data = ['key' => 'system_linka_index_top_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }

    public function testMobileFindTopicIndexTopSetting_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $data = ['key' => 'system_topic_index_top_settings'];
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['key'], $responseContent->data->key);

    }


}
