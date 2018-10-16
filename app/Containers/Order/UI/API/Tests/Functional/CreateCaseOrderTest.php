<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * Class FindOrderssTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateCaseOrderTest extends TestCase
{
    use WithFaker;

    protected $endpoint = 'post@v1/orders';

    public function testCreateCaseOrders_()
    {
        $guestDetails = [
            'wallets' => 10000,
        ];

        $guest =  $this->getTestingGuestWithoutAccess($guestDetails);

        $data = [
            'price' => 200.00,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        /*没有开通企业付款到零钱功能*/
        $this->assertResponseContainKeyValue([
            'status' => false,
            'msg' => '产品权限验证失败,请查看您当前是否具有该产品的权限',
            //            'status' => true,
            //            'msg' => '操作成功',
        ]);

        $this->assertEquals($guest->wallets ,$guestDetails['wallets'] - $data['price']);
    }

    public function testCreateCaseOrdersError_()
    {
        $guestDetails = [
            'wallets' => 10,
        ];

        $this->getTestingGuestWithoutAccess($guestDetails);

        $data = [
            'price'         => 200.00,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        /*没有开通企业付款到零钱功能*/
        $this->assertResponseContainKeyValue([
            'status' => false,
            'msg' => '零钱大于100才能提现余额',
        ]);

    }

}
