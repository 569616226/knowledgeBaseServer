<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class FindOrderssTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindCancelOrderTest extends TestCase
{

    protected $endpoint = 'get@v1/cancel_orders/{id}';
    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-cancel_orders',
    ];


    public function testFindCancelOrders_()
    {

        // send the HTTP request
        $response = $this->injectId($this->cancel_order->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->cancel_order->name, $responseContent->data->name);
        $this->assertEquals($this->cancel_order->order_no, $responseContent->data->order_no);
        $this->assertEquals($this->cancel_order->price, $responseContent->data->price);
        $this->assertEquals($this->order_pay_type[$this->cancel_order->pay_type], $responseContent->data->pay_type);
        $this->assertEquals($this->order_status[$this->cancel_order->status], $responseContent->data->status);
        $this->assertEquals($this->cancel_order->pay_time, $responseContent->data->pay_time);
        $this->assertEquals($this->cancel_order->cancel_res, $responseContent->data->cancel_res);
        $this->assertEquals($this->cancel_order->payee, $responseContent->data->payee);
    }

}
