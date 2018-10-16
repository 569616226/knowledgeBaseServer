<?php

namespace App\Containers\Guest\Data\Seeders;


use App\Containers\Answer\Models\Answer;
use App\Containers\Appoint\Models\Appoint;
use App\Containers\AppointAppraise\Models\AppointAppraise;
use App\Containers\AppointCase\Models\AppointCase;
use App\Containers\Article\Models\Article;
use App\Containers\Chat\Models\Chat;
use App\Containers\Finace\Models\Finace;
use App\Containers\Guest\Models\Guest;
use App\Containers\Message\Models\Message;
use App\Containers\Nav\Models\Nav;
use App\Containers\Order\Models\Order;
use App\Containers\Question\Models\Question;
use App\Containers\Topic\Models\Topic;
use App\Containers\User\Models\User;
use App\Ship\Parents\Seeders\Seeder;
use Illuminate\Support\Facades\DB;

class GuestSeeder extends Seeder
{
    public function run()
    {

        /*========创建用户========*/
        factory(Guest::class, 50)->create();
        $linkas = factory(Guest::class, 50)->create(['status' => 1]);
        $linkas_1 = factory(Guest::class, 50)->create(['status' => 1]);

        $linka = factory(Guest::class)->create([
            'name'     => '末',
            'open_id'  => 'oy_pR0RDamfo4Yh35rQ4Nvhid10o',
            'password' => \Illuminate\Support\Facades\Hash::make('oy_pR0RDamfo4Yh35rQ4Nvhid10o'),
            'status'   => 1,
            'wallets'  => 30000,
        ]);

        factory(Guest::class)->create([
            'name'     => 'Dream',
            'open_id'  => 'oy_pR0enpNXlEOHkSxkWR4yiQUTU',
            'password' => \Illuminate\Support\Facades\Hash::make('oy_pR0enpNXlEOHkSxkWR4yiQUTU'),
            'status'   => 3,
            'wallets'  => 30000,
        ]);

        $guest = factory(Guest::class)->create([
            'status' => 3,
        ]);

        /*==========私信数据==========*/
        $chats = factory(Chat::class, 66)->create();

        foreach ($chats as $key => $chat) {

            if (!$key) {

                $chat['pid'] = 0;
                $linka->chats()->attach([$chat->id => ['is_sender' => 1]]);

            } elseif ($key < 65) {

                $chat['pid'] = $chats[$key + 1]->id;

                if ($key % 2 == 0) {

                    $linka->chats()->attach([$chat->id => ['is_sender' => 1]]);

                } else {

                    $linka->chats()->attach([$chat->id => ['is_sender' => 0]]);

                }

            }

        }

        /*============问答数据============*/
        $answer = factory(Answer::class)->create([
            'name'       => '问提很好',
            'price'      => 200,
            'status'     => 2,
            'created_at' => now()->addMinute(4)
        ]);
        $answer_2 = factory(Answer::class)->create([
            'name'       => '问提很好',
            'price'      => 200,
            'status'     => 2,
            'created_at' => now()->addMinute(4)
        ]);
        $answer_3 = factory(Answer::class)->create([
            'name'       => '问提很好',
            'price'      => 200,
            'status'     => 2,
            'created_at' => now()->addMinute(4)
        ]);

        $guest->my_answers()->attach([
            $answer->id   => ['is_creator' => 1],
            $answer_2->id => ['is_creator' => 1],
            $answer_3->id => ['is_creator' => 1],
        ]);

        factory(Question::class)->create([
            'guest_id'   => $linka->id,
            'answer_id'  => $answer->id,
            'created_at' => now()->addMinute(5)
        ]);
        factory(Question::class)->create([
            'guest_id'   => $linka->id,
            'answer_id'  => $answer_2->id,
            'created_at' => now()->addMinute(5)
        ]);
        factory(Question::class)->create([
            'guest_id'   => $linka->id,
            'answer_id'  => $answer_3->id,
            'created_at' => now()->addMinute(5)
        ]);

        $answer_datas = factory(Answer::class, 105)->create();

        foreach ($answer_datas as $answer_data) {

            $answer_ids[$answer_data->id] = ['is_creator' => 1];

            factory(Question::class)->create([
                'guest_id'  => $linka->id,
                'answer_id' => $answer_data->id,
            ]);
        }

        $guest->my_answers()->attach($answer_ids);

        /*=========订单数据=======*/
        factory(Order::class)->create([
            'name'        => '待付款问答订单',
            'order_no'    => create_order_number(),
            'guest_id'    => $guest->id,
            'answer_id'   => $answer->id,
            'price'       => 200.00,
            'pay_type'    => 1,
            'answer_type' => 1,
            'status'      => 2,
            'pay_time'    => null,
            'cancel_res'  => null,
            'payee'       => null,

        ]);
        factory(Order::class)->create([
            'name'        => '退款中问答订单',
            'order_no'    => create_order_number(),
            'guest_id'    => $guest->id,
            'answer_id'   => $answer_2->id,
            'price'       => 200.00,
            'pay_type'    => 1,
            'answer_type' => 0,
            'status'      => 3,
            'pay_time'    => now()->timestamp,
            'cancel_res'  => null,
            'payee'       => null,
        ]);
        factory(Order::class)->create([
            'name'        => '已退款问答订单',
            'order_no'    => create_order_number(),
            'guest_id'    => $guest->id,
            'answer_id'   => $answer_3->id,
            'price'       => 200.00,
            'pay_type'    => 1,
            'answer_type' => 1,
            'status'      => 4,
            'pay_time'    => now()->timestamp,
            'cancel_res'  => null,
            'payee'       => null,
        ]);

        factory(Order::class, 250)->create(['guest_id' => $linka->id]);
        factory(Order::class, 50)->create([
            'guest_id'       => $linka->id,
            'answer_id'   => null,
            'appoint_id' => null,
        ]);

        /*=========交易记录=======*/
        factory(Finace::class, 50)->create(['guest_id' => $linka->id]);

        /*===========话题约见数据===========*/
        $topic = factory(Topic::class)->create([
            'title'      => '话题名字',
            'describe'   => '问题内容',
            'ser_type'   => 0,
            'ser_time'   => 0,
            'price'      => 200,
            'guest_id'   => $linka->id,
            'need_infos' => null,
            'remark'     => null,
            'created_at' => now()
        ]);
        $appoint = factory(Appoint::class)->create([
            'cancel_res' => null,
            'canceler'   => null,
            'answers'    => [0, 1, 2],
            'profile'    => '学员自我介绍',
            'guest_id'   => $guest->id,
            'topic_id'   => $topic->id,
            'created_at' => now()->addMinute()
        ]);
        $appoint_2 = factory(Appoint::class)->create([
            'cancel_res' => null,
            'canceler'   => null,
            'answers'    => [0, 1, 2],
            'profile'    => '学员自我介绍',
            'guest_id'   => $guest->id,
            'topic_id'   => $topic->id,
            'created_at' => now()->addMinute()
        ]);
        factory(AppointCase::class)->create([

            'appoint_time' => now(),
            'location'     => '约见地点',
            'guest_id'     => $linka->id,
            'appoint_id'   => optional($appoint)->id,
            'created_at'   => now()->addMinutes(2)
        ]);
        factory(AppointCase::class)->create([

            'appoint_time' => now(),
            'location'     => '约见地点',
            'guest_id'     => $linka->id,
            'appoint_id'   => optional($appoint_2)->id,
            'created_at'   => now()->addMinutes(2)
        ]);
        factory(AppointAppraise::class)->create([
            'star'       => 4,
            'degree'     => 3,
            'content'    => '老师很nice，对提出的总是回答的都很详细。很专业，很有针对性。',
            'appoint_id' => $appoint->id,
            'guest_id'   => $linka->id,
            'created_at' => now()->addMinutes(3)
        ]);


        /*============订单数据============*/
        factory(Order::class)->create([
            'name'        => '约见取消订单',
            'order_no'    => create_order_number(),
            'guest_id'    => $guest->id,
            'appoint_id'  => $appoint->id,
            'price'       => 200.00,
            'pay_type'    => 1,
            'status'      => 0,
            'pay_time'    => null,
            'cancel_res'  => '违约金取消原因',
            'payee'       => '违约金付款人',
            'is_cancel'   => true,
            'answer_type' => null,
        ]);

        factory(Order::class)->create([
            'name'        => '约见已付款订单',
            'order_no'    => create_order_number(),
            'guest_id'    => $guest->id,
            'appoint_id'  => $appoint_2->id,
            'price'       => 200.00,
            'pay_type'    => 1,
            'status'      => 1,
            'pay_time'    => now()->timestamp,
            'cancel_res'  => null,
            'payee'       => null,
            'answer_type' => null,
        ]);

        /*========user========*/
        $user = factory(User::class)->create();

        /*========分类========*/
        $nav = factory(Nav::class)->create([
            'pid'     => 0,
            'user_id' => $user->id
        ]);

        factory(Nav::class, 30)->create([
            'pid'     => 0,
            'user_id' => $user->id
        ]);

        $nav_1 = factory(Nav::class)->create([
            'pid'     => $nav->id,
            'user_id' => $user->id
        ]);

        $nav_2 = factory(Nav::class)->create([
            'pid'     => $nav->id,
            'user_id' => $user->id
        ]);

        $nav_1->guests()->attach($linkas->pluck('id')->toArray());
        $nav_2->guests()->attach($linkas_1->pluck('id')->toArray());

        /*===============数据填充：文章=============*/
        factory(Article::class, 105)->create(['guest_id' => $linka->id]);

        /*============消息数据=============*/
        $messages = factory(Message::class, 105)->create();
        $message_ids = $messages->pluck('id')->toArray();
        $linka->messages()->attach($message_ids);

        /*passport keys数据*/
        DB::table('oauth_clients')->insert([
            [
                'id'                     => 1,
                'name'                   => 'knowledgeBaseServer Personal Access Client',
                'redirect'               => 'http://localhost',
                'secret'                 => '0eW1fHf2RuSXg4TxQVnCYugguxX2LROCu9gE6VSc',
                'personal_access_client' => 1,
                'password_client'        => 0,
                'revoked'                => 0,
                'created_at'             => now(),
            ], [
                'id'                     => 2,
                'name'                   => 'knowledgeBaseServer Personal Access Client',
                'redirect'               => 'http://localhost',
                'secret'                 => 'AObTtlpDg5TKEEXbnb7DH7hyAkRWycweZ55zWIwt',
                'personal_access_client' => 0,
                'password_client'        => 1,
                'revoked'                => 0,
                'created_at'             => now(),
            ], [
                'id'                     => 3,
                'name'                   => 'knowledgeBaseServer Personal Access Client',
                'redirect'               => 'http://localhost',
                'secret'                 => 'KkcKrXn4oIgsR3SAQvNMGoFyM7lsONCXpTmZnQCo',
                'personal_access_client' => 1,
                'password_client'        => 0,
                'revoked'                => 0,
                'created_at'             => now(),
            ], [
                'id'                     => 4,
                'name'                   => 'knowledgeBaseServer Personal Access Client',
                'redirect'               => 'http://localhost',
                'secret'                 => 'mjXWziyuhBX91WiYSCzdDtcmKXi9U2gG0CyBjQmo',
                'personal_access_client' => 0,
                'password_client'        => 1,
                'revoked'                => 0,
                'created_at'             => now(),
            ]
        ]);

    }
}
