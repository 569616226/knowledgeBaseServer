<?php

namespace App\Containers\Order\UI\API\Tests\Functional;


use App\Containers\Tests\TestCase;

/**
 * Class FindOrderssTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindCaseOrderTest extends TestCase
{

    protected $endpoint = 'get@v1/case_orders/{id}';
    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-finace_cases',
    ];


    public function testFindCaseOrders_()
    {

        // send the HTTP request
        $response = $this->injectId($this->case_order->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->case_order->price, $responseContent->data->price);
        $this->assertEquals($this->refund_way[$this->case_order->refund_way], $responseContent->data->refund_way);
        $this->assertEquals($this->refund_status[$this->case_order->refund_status], $responseContent->data->refund_status);
        $this->assertEquals($this->case_order->refund_auditor, $responseContent->data->refund_auditor);
        $this->assertEquals($this->refund_audit_status[$this->case_order->refund_audit_status], $responseContent->data->refund_audit_status);
        $this->assertEquals($this->case_order->refund_audit_remark, $responseContent->data->refund_audit_remark);
    }


}
