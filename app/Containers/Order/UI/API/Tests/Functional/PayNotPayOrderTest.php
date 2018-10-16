<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class FindOrderssTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class PayNotPayOrderTest extends TestCase
{

    protected $endpoint = 'get@v1/answers/{id}/pay_not_pay_order';

    public function testCreateSeeAnswerOrders_()
    {

        $this->getTestingGuestWithoutAccess();

        // send the HTTP request
        $response = $this->injectId($this->answer->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeys([

            'answer_id',

            'appId',
            'nonceStr',
            'package',
            'signType',
            'paySign',
            'timestamp',
        ]);

    }

}
