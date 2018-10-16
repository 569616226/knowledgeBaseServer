<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/7
 * Time: 11:53
 */

namespace App\Containers\Appoint\UI\API\Tests\Functional;

use App\Containers\Appoint\Models\Appoint;
use App\Containers\Tests\TestCase;

class GetGuestNoComplateAppointsTest extends TestCase
{
    protected $endpoint = 'get@v1/guest_no_complate_appoints';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testGetGuestNoComplateAllAppoints_()
    {
        $guest = $this->getTestingGuestWithoutAccess();
        factory(Appoint::class)->create(
            [
                'cancel_res' => '违约金订单 取消原因',
                'canceler'   => '违约金订单 取消人',
                'answers'    => '[0,1,2]',
                'profile'    => '学员自我介绍',
                'status'     => 1,
                'guest_id'   => $guest->id,
                'topic_id'   => $this->topic->id,
            ]
        );

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $appoint_no_complates = $guest->appoints()->where('status','!=',5)->paginate()->count();
        // assert the returned data size is correct
        $this->assertCount($appoint_no_complates, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }
}