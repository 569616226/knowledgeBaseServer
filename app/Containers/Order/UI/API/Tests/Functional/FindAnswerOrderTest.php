<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class FindOrderssTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindAnswerOrderTest extends TestCase
{

    protected $endpoint = 'get@v1/answer_orders/{id}';
    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-answer_orders',
    ];

    public function testFindAnswerOrders_()
    {

        // send the HTTP request
        $response = $this->injectId($this->answer_order->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->answer_order->name, $responseContent->data->name);
        $this->assertEquals($this->answer_order->order_no, $responseContent->data->order_no);
        $this->assertEquals($this->answer_order->price, $responseContent->data->price);
        $this->assertEquals($this->order_pay_type[$this->answer_order->pay_type], $responseContent->data->pay_type);
        $this->assertEquals($this->order_status[$this->answer_order->status], $responseContent->data->status);
        $this->assertEquals($this->answer_order->pay_time, $responseContent->data->pay_time);
        $this->assertEquals($this->answer_order_type[$this->answer_order->answer_type], $responseContent->data->answer_type);
        $this->assertEquals($this->answer_status[$this->answer_order->answer->status], $responseContent->data->answer_status);
    }

}
