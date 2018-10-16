<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 17:02
 */

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\Order\Models\Order;
use App\Containers\Tests\TestCase;

class GetAllCancelOrdersTest extends TestCase
{
    protected $endpoint = 'get@v1/cancels/orders';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-cancel_orders',
    ];

    public function testGetAllCancelsOrders_()
    {

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $cancel_counts = Order::whereNotNull('appoint_id')->where('is_cancel', true)->get()->count();
        // assert the returned data size is correct
        $this->assertCount($cancel_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }
}