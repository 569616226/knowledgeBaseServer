<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class UpdateOrderTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ChangeOrderAuditStatusTest extends TestCase
{

    protected $endpoint = 'put@v1/orders/audit/status/{id}';

    protected $access = [
        'roles'       => 'finace',
        'permissions' => 'manage-finace_aduit',
    ];

    public function testChangeOrderAuditStatus0_()
    {
        $this->getTestingGuestWithoutAccess();

        $data = [
            'refund_audit_status' => 0,
            'refund_audit_remark' => '审核不通过',
        ];

        // send the HTTP request
        $response = $this->injectId($this->answer_order->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => "操作成功",
        ]);
    }

    /*无法每次都此时，开发时解开测试*/
//    public function testChangeOrderAuditStatus1_()
//    {
//        $this->getTestingGuestWithoutAccess();
//
//        $data = [
//            'refund_audit_status' => 1,
//            'refund_audit_remark' => '审核通过',
//        ];
//
//        // send the HTTP request
//        $response = $this->injectId($this->answer_order->id)->makeCall($data);
//
//        // assert response status is correct
//        $response->assertStatus(200);
//
//        $this->assertResponseContainKeyValue([
//            'status' => true,
//            'msg'    => "操作成功",
//        ]);
//    }
}
