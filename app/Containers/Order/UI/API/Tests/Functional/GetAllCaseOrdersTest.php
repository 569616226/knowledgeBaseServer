<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 16:59
 */

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\Order\Models\Order;
use App\Containers\Tests\TestCase;

class GetAllCaseOrdersTest extends TestCase
{
    protected $endpoint = 'get@v1/case_orders';

    protected $access = [
        'roles'       => 'finace',
        'permissions' => 'manage-finace_cases',
    ];

    public function testGetAllCaseOrders_()
    {

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $case_counts = Order::whereNull('appoint_id')->whereNull('answer_id')->get()->count();

        // assert the returned data size is correct
        $this->assertCount($case_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }
}