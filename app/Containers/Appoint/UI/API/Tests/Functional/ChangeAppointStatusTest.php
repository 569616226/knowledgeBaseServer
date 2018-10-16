<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 13:53
 */

namespace App\Containers\Appoint\UI\API\Tests\Functional;

use App\Containers\Appoint\Models\Appoint;
use App\Containers\Order\Models\Order;
use App\Containers\Tests\TestCase;
use App\Containers\Topic\Models\Topic;

class ChangeAppointStatusTest extends TestCase
{
    protected $endpoint = 'post@v1/appoints/{id}/change_status';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testChangeNoPayAppointStatusTo0WithGuest_()
    {

        $guest = $this->getTestingGuestWithoutAccess();
        $appoint = factory(Appoint::class)->create(
            [
                'cancel_res' => null,
                'canceler'   => null,
                'answers'    => '[0,1,2]',
                'profile'    => '学员自我介绍',
                'status'     => 1,
                'guest_id'   => $guest->id,
                'topic_id'   => $this->topic->id,
                'created_at' => now()->addMinute(12)
            ]
        );

        factory(Order::class)->create([
            'appoint_id'  => $appoint->id,
            'status'      => 2,
            'answer_type' => null,
        ]);

        $data = [
            'status'     => 0,
            'cancel_res' => '工作太忙',
        ];

        // send the HTTP request
        $response = $this->injectId($appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => '操作成功',
        ]);

        if (env('SEND_WECHAT_TEMP_MSG')) {

            $msgs = $this->linka_1->messages;
            $this->assertCount(1, $msgs);

            $content = '话题约见:' . $appoint->topic->title;

            $this->assertEquals($content, $msgs->first()->content);
            $this->assertEquals('学员取消本次预约，取消原因：' . $data['cancel_res'], $msgs->first()->title);
        }

    }

    public function testChangePayAppointStatusTo0WithGuest_()
    {

        $guest = $this->getTestingGuestWithoutAccess();
        $appoint = factory(Appoint::class)->create(
            [
                'cancel_res' => null,
                'canceler'   => null,
                'answers'    => '[0,1,2]',
                'profile'    => '学员自我介绍',
                'status'     => 3,
                'guest_id'   => $guest->id,
                'topic_id'   => $this->topic->id,
                'created_at' => now()->addMinute(12)
            ]
        );

        factory(Order::class)->create([
            'appoint_id'  => $appoint->id,
            'status'      => 1,
            'pay_time'    => now(),
            'answer_type' => null,
        ]);

        $data = [
            'status'     => 0,
            'cancel_res' => '工作太忙',
        ];

        // send the HTTP request
        $response = $this->injectId($appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeys([

            'appoint_id',

            'appId',
            'nonceStr',
            'package',
            'signType',
            'paySign',
            'timestamp',

        ]);

    }

    public function testChangeAppointStatusTo0WithLinka_()
    {

        $linka = $this->getTestingGuestWithoutAccess(['status' => 1]);
        $topic = factory(Topic::class)->create(
            [
                'title'      => '话题名字',
                'describe'   => '问题内容',
                'status'     => 1,
                'ser_type'   => 0,
                'ser_time'   => 0,
                'price'      => 200,
                'guest_id'   => $linka->id,
                'need_infos' => null,
                'remark'     => null,
                'created_at' => now()->addMinute(11)
            ]
        );

        $appoint = factory(Appoint::class)->create(
            [
                'cancel_res' => null,
                'canceler'   => null,
                'answers'    => '[0,1,2]',
                'profile'    => '学员自我介绍',
                'status'     => 3,
                'guest_id'   => $this->guest->id,
                'topic_id'   => $topic->id,
                'created_at' => now()->addMinute(12)
            ]
        );

        factory(Order::class)->create([
            'appoint_id'  => $appoint->id,
            'status'      => 1,
            'pay_time'    => now(),
            'answer_type' => null,
        ]);


        $data = [
            'status'     => 0,
            'cancel_res' => '工作太忙',
        ];

        // send the HTTP request
        $response = $this->injectId($appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeys([
            'appoint_id',
            'appId',
            'nonceStr',
            'package',
            'signType',
            'paySign',
            'timestamp',
        ]);

    }

    public function testChangeAppointStatusTo1_()
    {

        $this->getTestingGuestWithoutAccess();

        $data = [
            'status' => 1
        ];

        // send the HTTP request
        $response = $this->injectId($this->appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => '操作成功',
        ]);


    }

    public function testChangeAppointStatusTo2_()
    {

        $linka = $this->getTestingGuestWithoutAccess(['status' => 1]);
        $topic = factory(Topic::class)->create(
            [
                'title'      => '话题名字',
                'describe'   => '问题内容',
                'status'     => 0,
                'ser_type'   => 0,
                'ser_time'   => 0,
                'price'      => 200,
                'guest_id'   => $linka->id,
                'need_infos' => null,
                'remark'     => null,
                'created_at' => now()->addMinute(11)
            ]
        );
        $appoint = factory(Appoint::class)->create(
            [
                'cancel_res' => null,
                'canceler'   => null,
                'answers'    => '[0,1,2]',
                'profile'    => '学员自我介绍',
                'status'     => 1,
                'guest_id'   => $this->guest->id,
                'topic_id'   => $topic->id,
                'created_at' => now()->addMinute(12)
            ]
        );

        $data = [
            'status' => 2,
        ];

        // send the HTTP request
        $response = $this->injectId($this->appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => '操作成功',
        ]);

        if (env('SEND_WECHAT_TEMP_MSG')) {
            $msgs = $this->guest->messages;
            $this->assertCount(1, $msgs);

            $content = '话题约见:' . $appoint->topic->title;

            $this->assertEquals($content, $msgs->first()->content);
            $this->assertEquals('大咖已接受您的预约，快选个时间地点见面吧！', $msgs->first()->title);
        }

    }

    public function testChangeAppointStatusTo3_()
    {

        $linka = $this->getTestingGuestWithoutAccess(['status' => 1]);
        $topic = factory(Topic::class)->create(
            [
                'title'      => '话题名字',
                'describe'   => '问题内容',
                'status'     => 0,
                'ser_type'   => 0,
                'ser_time'   => 0,
                'price'      => 200,
                'guest_id'   => $linka->id,
                'need_infos' => null,
                'remark'     => null,
                'created_at' => now()->addMinute(11)
            ]
        );

        factory(Appoint::class)->create(
            [
                'cancel_res' => null,
                'canceler'   => null,
                'answers'    => '[0,1,2]',
                'profile'    => '学员自我介绍',
                'status'     => 1,
                'guest_id'   => $this->guest->id,
                'topic_id'   => $topic->id,
                'created_at' => now()->addMinute(12)
            ]
        );

        $data = [
            'status'   => 3,
            'cases_id' => 1,
        ];

        // send the HTTP request
        $response = $this->injectId($this->appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeys([
            'appoint_id',
            'appId',
            'nonceStr',
            'package',
            'signType',
            'paySign',
            'timestamp',
        ]);

    }

    public function testChangeAppointStatusTo4_()
    {

        $linka = $this->getTestingGuestWithoutAccess(['status' => 1]);
        $topic = factory(Topic::class)->create(
            [
                'title'      => '话题名字',
                'describe'   => '问题内容',
                'status'     => 0,
                'ser_type'   => 0,
                'ser_time'   => 0,
                'price'      => 200,
                'guest_id'   => $linka->id,
                'need_infos' => null,
                'remark'     => null,
                'created_at' => now()->addMinute(11)
            ]
        );
        $appoint = factory(Appoint::class)->create(
            [
                'cancel_res' => null,
                'canceler'   => null,
                'answers'    => '[0,1,2]',
                'profile'    => '学员自我介绍',
                'status'     => 1,
                'guest_id'   => $this->guest->id,
                'topic_id'   => $topic->id,
                'created_at' => now()->addMinute(12)
            ]
        );

        $data = [
            'status' => 4,
        ];

        // send the HTTP request
        $response = $this->injectId($this->appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => '操作成功',
        ]);

        if (env('SEND_WECHAT_TEMP_MSG')) {
            $msgs = $this->guest->messages;
            $this->assertCount(1, $msgs);

            $content = '话题约见:' . $appoint->topic->title;

            $this->assertEquals($content, $msgs->first()->content);
            $this->assertEquals('邀请您对此次会面进行评价，分享会面心得吧！', $msgs->first()->title);
        }
    }

    public function testChangeAppointStatusTo5_()
    {

        $this->getTestingGuestWithoutAccess();

        $data = [
            'status' => 5
        ];

        // send the HTTP request
        $response = $this->injectId($this->appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => '操作成功',
        ]);

    }

    public function testChangeAppointStatusTo6_()
    {

        $linka = $this->getTestingGuestWithoutAccess(['status' => 1]);
        $topic = factory(Topic::class)->create(
            [
                'title'      => '话题名字',
                'describe'   => '问题内容',
                'status'     => 0,
                'ser_type'   => 0,
                'ser_time'   => 0,
                'price'      => 200,
                'guest_id'   => $linka->id,
                'need_infos' => null,
                'remark'     => null,
                'created_at' => now()->addMinute(11)
            ]
        );
        $appoint = factory(Appoint::class)->create(
            [
                'cancel_res' => null,
                'canceler'   => null,
                'answers'    => '[0,1,2]',
                'profile'    => '学员自我介绍',
                'status'     => 1,
                'guest_id'   => $this->guest->id,
                'topic_id'   => $topic->id,
                'created_at' => now()->addMinute(12)
            ]
        );


        $data = [
            'status'     => 6,
            'cancel_res' => '不想出门，天气太热',
        ];

        // send the HTTP request
        $response = $this->injectId($appoint->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => '操作成功',
        ]);

        if (env('SEND_WECHAT_TEMP_MSG')) {
            $msgs = $this->guest->messages;
            $this->assertCount(1, $msgs);

            $content = '话题约见:' . $appoint->topic->title;

            $this->assertEquals($content, $msgs->first()->content);
            $this->assertEquals('大咖拒绝本次预约，拒绝原因：' . $data['cancel_res'], $msgs->first()->title);
        }
    }

}