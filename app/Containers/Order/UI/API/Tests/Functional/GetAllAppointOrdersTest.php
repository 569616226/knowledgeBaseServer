<?php

namespace App\Containers\Order\UI\API\Tests\Functional;


use App\Containers\Order\Models\Order;
use App\Containers\Tests\TestCase;

/**
 * Class GetAllOrdersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllAppointOrdersTest extends TestCase
{

    protected $endpoint = 'get@v1/appoint_orders';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-appoint_orders',
    ];

    public function testGetAllAppointsOrders_()
    {

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $appoint_counts = Order::whereNotNull('appoint_id')->where('is_cancel', false)->get()->count();
        // assert the returned data size is correct
        $this->assertCount($appoint_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }

}
