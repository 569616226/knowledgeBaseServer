<?php

namespace App\Containers\Tests;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Advert\Models\Advert;
use App\Containers\Answer\Models\Answer;
use App\Containers\Appoint\Models\Appoint;
use App\Containers\AppointAppraise\Models\AppointAppraise;
use App\Containers\AppointCase\Models\AppointCase;
use App\Containers\Article\Models\Article;
use App\Containers\Chat\Models\Chat;
use App\Containers\Comment\Models\Comment;
use App\Containers\Group\Models\Group;
use App\Containers\Guest\Models\Guest;
use App\Containers\Menu\Models\Menu;
use App\Containers\Nav\Models\Nav;
use App\Containers\Order\Models\Order;
use App\Containers\Question\Models\Question;
use App\Containers\Topic\Models\Topic;
use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;

/**
 * Class TestCase
 *
 * Container TestCase class. Use this class to put your container specific tests helper functions.
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class TestCase extends ShipTestCase
{
    protected $guest;
    protected $linka_1;
    protected $linka_2;
    protected $linka_3;
    protected $topic;
    protected $topic_2;
    protected $topic_3;
    protected $appoint;
    protected $appoint_case;
    protected $appoint_appraise;
    protected $appoint_2;
    protected $appoint_case_2;
    protected $appoint_appraise_2;
    protected $group;
    protected $anotherGroup;
    protected $answer;
    protected $answer_1;
    protected $answer_2;
    protected $answer_3;
    protected $question;
    protected $nav;
    protected $answer_order;
    protected $appoint_order;
    protected $cancel_order;
    protected $case_order;
    protected $menu;
    protected $article;
    protected $chat;
    protected $advert;
    protected $comment;
    protected $answer_status = [
        0 => '待回答',
        1 => '已回答',
        2 => '已关闭',
        3 => '待付款',
    ];
    protected $status = [
        0 => '已取消',
        1 => '待付款',
        2 => '待确认',
        3 => '待见面',
        4 => '待评价',
        5 => '已完成',
        6 => '已拒绝',
    ];

    protected $topic_status = [
        0 => '审核失败',
        1 => '审核通过',
        2 => '待审核',
    ];

    protected $order_pay_type = [
        0 => '微信支付'
    ];
    protected $order_status = [
        0 => '已关闭',
        1 => '已付款',
        2 => '待付款',
        3 => '退款中',
        4 => '已退款',
        5 => '已完成',

    ];

    protected $answer_order_type = [
        0 => '提问题',
        1 => '看答案',
    ];

    protected $refund_audit_status = [
        0 => '审核失败',
        1 => '审核通过',
        2 => '待审核',
    ];
    protected $refund_status = [
        0 => '转账失败',
        1 => '转账通过',
        2 => '待转账',
    ];
    protected $refund_way = [
        0 => '原路退回',
        1 => '微信钱包',
    ];

    protected $guest_status = [
        0 => '审核失败',
        1 => '审核通过',
        2 => '待审核',
        3 => '普通用户'
    ];

    protected $gender = [
        0 => '女',
        1 => '男',
        2 => '未知',
    ];
    protected $msg_type = [
        0 => '系统消息',
        1 => '图文',
        2 => '纯文本',
    ];

    protected $ser_type = [
        0 => '线下约见',
        1 => '全国通话',
    ];


    public function setUp()
    {
        parent::setUp();

        $this->guest = factory(Guest::class)->create([
            'status' => 3
        ]);

        $this->linka_1 = factory(Guest::class)->create([
            'status' => 1
        ]);

        $this->linka_2 = factory(Guest::class)->create([
            'status' => 1
        ]);

        $this->linka_3 = factory(Guest::class)->create([
            'status' => 1
        ]);

        $this->group = factory(Group::class)->create();
        $this->anotherGroup = factory(Group::class)->create();

        $this->group->guests()->attach([$this->guest->id, $this->linka_1->id, $this->linka_2->id]);

        /*待回答*/
        $this->answer = factory(Answer::class)->create([
            'status'     => 0,
            'created_at' => now()->addMinute(8)
        ]);

        /*已回答*/
        $this->answer_1 = factory(Answer::class)->create([
            'status'     => 1,
            'star'       => 2,
            'created_at' => now()->addMinute(9)
        ]);

        $this->answer_2 = factory(Answer::class)->create([
            'status'     => 1,
            'star'       => 3,
            'created_at' => now()->addMinute(10)
        ]);

        $this->answer_3 = factory(Answer::class)->create([
            'status'     => 1,
            'star'       => 4,
            'created_at' => now()->addMinute(11)
        ]);

        $this->guest->my_answers()->attach([
            $this->answer->id   => ['is_creator' => 1],
            $this->answer_2->id => ['is_creator' => 1],
            $this->answer_3->id => ['is_creator' => 1],
            $this->answer_1->id => ['is_creator' => 1]
        ]);

        /*查看问题*/
        $guests = factory(Guest::class, 10)->create(['status' => 3]);
        foreach ($guests->pluck('id')->toArray() as $guest) {
            $this->answer_2->readers()->attach([$guest => ['is_reader' => 1]]);
        }

        $this->question = factory(Question::class)->create([
            'answer_id'  => $this->answer->id,
            'guest_id'   => $this->linka_2->id,
            'created_at' => now()->addMinute(10)
        ]);

        /*回答内容*/
        factory(Question::class)->create([
            'answer_id'  => $this->answer_1->id,
            'guest_id'   => $this->linka_1->id,
            'content'    => 'ddfdfsdfds',
            'created_at' => now()->addMinute(13)
        ]);

        factory(Question::class)->create([
            'answer_id'  => $this->answer_2->id,
            'guest_id'   => $this->linka_1->id,
            'content'    => 'ddfdfsdfds',
            'created_at' => now()->addMinute(13)
        ]);

        factory(Question::class)->create([
            'answer_id'  => $this->answer_3->id,
            'guest_id'   => $this->linka_1->id,
            'content'    => 'ddfdfsdfds',
            'created_at' => now()->addMinute(13)
        ]);

        $this->topic = factory(Topic::class)->create(
            [
                'title'      => '话题名字',
                'describe'   => '问题内容',
                'status'     => 1,
                'ser_type'   => 0,
                'ser_time'   => 0,
                'price'      => 200,
                'guest_id'   => $this->linka_1->id,
                'need_infos' => null,
                'remark'     => null,
                'created_at' => now()->addMinute(11)
            ]
        );

        $this->topic_2 = factory(Topic::class)->create(
            [
                'title'      => '话题名字',
                'describe'   => '问题内容',
                'status'     => 1,
                'ser_type'   => 1,
                'ser_time'   => 0,
                'price'      => 180,
                'guest_id'   => $this->linka_2->id,
                'need_infos' => null,
                'remark'     => null,
                'created_at' => now()->addMinute(30)
            ]
        );

        $this->topic_3 = factory(Topic::class)->create(
            [
                'title'      => '话题名字',
                'describe'   => '问题内容',
                'status'     => 1,
                'ser_type'   => 1,
                'ser_time'   => 0,
                'price'      => 60,
                'guest_id'   => $this->linka_3->id,
                'need_infos' => null,
                'remark'     => null,
                'created_at' => now()->addMinute(11)
            ]
        );

        $this->appoint = factory(Appoint::class)->create(
            [
                'cancel_res' => null,
                'canceler'   => null,
                'answers'    => [0, 1, 2],
                'profile'    => '学员自我介绍',
                'status'     => 1,
                'guest_id'   => $this->guest->id,
                'topic_id'   => $this->topic->id,
                'created_at' => now()->addMinute(12)
            ]
        );

        factory(Appoint::class)->create(
            [
                'cancel_res' => null,
                'canceler'   => null,
                'answers'    => [0, 1, 2],
                'profile'    => '学员自我介绍',
                'status'     => 5,
                'guest_id'   => $this->guest->id,
                'topic_id'   => $this->topic_3->id,
                'created_at' => now()->addMinute(20)
            ]
        );
        factory(Appoint::class)->create(
            [
                'cancel_res' => null,
                'canceler'   => null,
                'answers'    => [0, 1, 2],
                'profile'    => '学员自我介绍',
                'status'     => 5,
                'guest_id'   => $this->guest->id,
                'topic_id'   => $this->topic_3->id,
                'created_at' => now()->addMinute(20)
            ]
        );

        $this->appoint_case = factory(AppointCase::class)->create(
            [
                'appoint_time' => now(),
                'location'     => '约见地点',
                'guest_id'     => $this->linka_1->id,
                'appoint_id'   => $this->appoint->id,
                'created_at'   => now()->addMinute(13)
            ]
        );

        $this->appoint_appraise = factory(AppointAppraise::class)->create(
            [
                'star'       => 4,
                'degree'     => 3,
                'content'    => '老师很nice，对提出的总是回答的都很详细。很专业，很有针对性。',
                'appoint_id' => $this->appoint->id,
                'guest_id'   => $this->linka_1->id,
                'created_at' => now()->addMinute(14)
            ]
        );

        $this->appoint_2 = factory(Appoint::class)->create(
            [
                'cancel_res' => '违约金订单 取消原因',
                'canceler'   => '违约金订单 取消人',
                'answers'    => [0, 1, 2],
                'profile'    => '学员自我介绍',
                'status'     => 1,
                'guest_id'   => $this->guest->id,
                'topic_id'   => $this->topic->id,
                'created_at' => now()->addMinute(50)
            ]
        );

        $this->appoint_case_2 = factory(AppointCase::class)->create(
            [

                'appoint_time' => now(),
                'location'     => '约见地点',
                'guest_id'     => $this->linka_1->id,
                'appoint_id'   => $this->appoint_2->id,
                'created_at'   => now()->addMinute(13)
            ]
        );

        $this->appoint_appraise_2 = factory(AppointAppraise::class)->create(
            [
                'star'       => 4,
                'degree'     => 3,
                'content'    => '老师很nice，对提出的总是回答的都很详细。很专业，很有针对性。',
                'appoint_id' => $this->appoint_2->id,
                'guest_id'   => $this->linka_1->id,
                'created_at' => now()->addMinute(14)
            ]
        );

        $this->answer_order = factory(Order::class)->create([
            'answer_id'   => $this->answer->id,
            'status'      => 2,
            'answer_type' => 0,
        ]);

        $this->appoint_order = factory(Order::class)->create([
            'appoint_id'  => $this->appoint->id,
            'status'      => 2,
            'answer_type' => null,
        ]);

        $this->cancel_order = factory(Order::class)->create([
            'appoint_id'  => $this->appoint_2->id,
            'status'      => 2,
            'is_cancel'   => true,
            'cancel_res'  => '违约金订单 取消原因',
            'payee'       => '收款人',
            'answer_type' => null,
        ]);

        $this->case_order = factory(Order::class)->create([
            'appoint_id'          => null,
            'answer_id'           => null,
            'status'              => 2,
            'refund_way'          => 0,
            'refund_audit_status' => 2,
            'refund_status'       => 2,
            'answer_type'         => null,
        ]);

        $this->menu = factory(Menu::class)->create();
        $role = Apiato::call('Authorization@FindRoleTask', [1]);

        $role->menus()->attach($this->menu->id);

        $this->nav = factory(Nav::class)->create();
        $this->nav->guests()->attach([$this->linka_1->id, $this->linka_2->id, $this->linka_3->id]);

        $this->advert = factory(Advert::class)->create();

        $this->article = factory(Article::class)->create(['guest_id' => $this->linka_1]);
        $this->comment = factory(Comment::class)->create([
            'article_id' => $this->article->id,
            'guest_id'   => $this->guest->id,
        ]);


        /*==========私信数据==========*/
        $chats = factory(Chat::class, 66)->create();

        foreach ($chats as $key => $chat) {

            if (!$key) {

                $chat['pid'] = 0;
                $this->linka_1->chats()->attach([$chat->id => ['is_sender' => 1]]);

            } elseif ($key < 65) {

                $chat['pid'] = $chats[$key]->id;

                if ($key % 2 == 0) {

                    $this->linka_1->chats()->attach([$chat->id => ['is_sender' => 1]]);

                } else {

                    $this->linka_1->chats()->attach([$chat->id => ['is_sender' => 0]]);

                }

            }

        }


    }

    /**
     * Reset the test environment, after each test.
     */
    public function tearDown()
    {
        parent::tearDown();
    }

}
