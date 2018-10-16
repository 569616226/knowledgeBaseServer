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
use App\Containers\Topic\Models\Topic;

class GetLinkaNoComplateAppointsTest extends TestCase
{
    protected $endpoint = 'get@v1/linka_appoint_no_complates';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testGetLinkaNoComplateAppoints_()
    {
        $guest = $this->getTestingGuestWithoutAccess();

        $topic = factory(Topic::class)->create(
            [
                'title'      => '话题名字',
                'describe'   => '问题内容',
                'status'     => 0,
                'ser_type'   => 0,
                'ser_time'   => 0,
                'price'      => 200,
                'guest_id'   => $guest->id,
                'need_infos' => null,
                'remark'     => null,
            ]
        );

        factory(Appoint::class)->create(
            [
                'cancel_res' => '违约金订单 取消原因',
                'canceler'   => '违约金订单 取消人',
                'answers'    => '[0,1,2]',
                'profile'    => '学员自我介绍',
                'status'     => 1,
                'guest_id'   => $this->guest->id,
                'topic_id'   => $topic->id,
            ]
        );


        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        $this->assertCount(1, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }
}