<?php

namespace App\Containers\Message\Data\Seeders;

use App\Containers\Guest\Models\Guest;
use App\Containers\Message\Models\Message;
use App\Ship\Parents\Seeders\Seeder;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $guest = factory(Guest::class)->create(['status' => 3]);

        $msg_0 = factory(Message::class)->create([
                'sender'   => '系统',
                'group_name' => '发送标签名',
                'img_url' => '发送标签名',
                'title'    => 'AEO政策解读与实地认证开课了！！',
                'content'  => "关务首席专家--金鹏远老师亲自授课，为您一一讲解AEO最新的政策解读，同时还有实地认证过程中的各种预防提醒，满满的干货哦！！！！",
                'msg_type' => 0,
            ]);

        $msg_1 = factory(Message::class)->create(
            [
                'sender' => 'admin',
                'group_name' => '发送标签名',
                'img_url' => '发送标签名',
                'title'    => '如何营造线上与线下互通的社群',
                'content'  => "近些年来，网络教育平台发展迅速，用户数量也在逐年递增，您觉得它今后的发展前景如何？网络教育最终真的会和传统教育平起平坐吗？",
                'msg_type' => 1,
            ]);

        $msg_2 = factory(Message::class)->create(
            [
                'sender'   => 'admin',
                'group_name' => '发送标签名',
                'img_url' => '发送标签名',
                'title'    => '如何营造线上与线下互通的社群',
                'content'  => "近些年来，网络教育平台发展迅速，用户数量也在逐年递增，您觉得它今后的发展前景如何？网络教育最终真的会和传统教育平起平坐吗？",
                'msg_type' => 2,
            ]);

        $guest->messages()->attach([$msg_1->id, $msg_2->id, $msg_0->id]);
    }
}
