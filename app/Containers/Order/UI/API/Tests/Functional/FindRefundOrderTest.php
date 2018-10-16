<?php

namespace App\Containers\Order\UI\API\Tests\Functional;


use App\Containers\Order\Models\Order;
use App\Containers\Tests\TestCase;

/**
 * Class FindOrderssTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindRefundOrderTest extends TestCase
{

    protected $endpoint = 'get@v1/refund_orders/{id}';
    protected $access = [
        'roles'       => 'finace',
        'permissions' => 'manage-finace_refunds',
    ];

    public function testFindRefundOrders_()
    {

        $order = factory(Order::class)->create([
            'appoint_id'   => $this->appoint->id,
            'status'         => 3
        ]);

        // send the HTTP request
        $response = $this->injectId($order->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($order->name, $responseContent->data->name);
        $this->assertEquals($order->order_no, $responseContent->data->order_no);
        $this->assertEquals($order->price, $responseContent->data->price);
        $this->assertEquals($this->order_pay_type[$order->pay_type], $responseContent->data->pay_type);
        $this->assertEquals($this->order_status[$order->status], $responseContent->data->status);
        $this->assertEquals($order->pay_time, $responseContent->data->pay_time);
        $this->assertEquals($order->cancel_res, $responseContent->data->cancel_res);
        $this->assertEquals($order->payee, $responseContent->data->payee);
    }

}
