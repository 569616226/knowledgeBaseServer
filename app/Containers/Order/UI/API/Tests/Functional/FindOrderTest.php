<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Tests\TestCase;

/**
 * Class FindOrderssTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindOrderTest extends TestCase
{

    protected $endpoint = 'get@v1/orders/{id}';
    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-appoint_orders',
    ];

    public function testFindOrders_()
    {

        // send the HTTP request
        $response = $this->injectId($this->appoint_order->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->appoint_order->name, $responseContent->data->name);
        $this->assertEquals($this->appoint_order->order_no, $responseContent->data->order_no);
        $this->assertEquals($this->appoint_order->price, $responseContent->data->price);
        $this->assertEquals($this->order_pay_type[$this->appoint_order->pay_type], $responseContent->data->pay_type);
        $this->assertEquals($this->order_status[$this->appoint_order->status], $responseContent->data->status);
        $this->assertEquals($this->appoint_order->pay_time, $responseContent->data->pay_time);
        $this->assertEquals($this->status[$this->appoint_order->appoint->status], $responseContent->data->appoint_status);
    }

    public function testFindOrdersWithRelation_()
    {

        // send the HTTP request
        $response = $this->injectId($this->appoint_order->id)->endpoint($this->endpoint . '?include=guest')->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $guest = Apiato::call('Guest@FindGuestByIdTask', [$this->appoint_order->guest_id]);

        $this->assertEquals($this->appoint_order->name, $responseContent->data->name);
        $this->assertEquals($guest->name, $responseContent->data->guest->data->name);

    }

}
