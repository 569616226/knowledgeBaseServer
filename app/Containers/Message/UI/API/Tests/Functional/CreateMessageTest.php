<?php

namespace App\Containers\Message\UI\API\Tests\Functional;


use App\Containers\Message\Models\Message;
use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateMessageTest extends TestCase
{

    protected $endpoint = 'post@v1/messages';

    protected $access = [
        'permissions' => 'manage-messages',
        'roles'       => '',
    ];


    public function testCreateTextMessage_()
    {

        $user = $this->getTestingUser();

        $data = [
            'title'    => $this->faker->title,
            'group_id' => $this->group->id,
            'content'  => $this->faker->word,
            'img_url'  => null,
            'msg_type' => 1,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'title'    => $data['title'],
            'content'  => $data['content'],
            'img_url'  => $data['img_url'],
            'msg_type' => $this->msg_type[$data['msg_type']],
            'is_read'  => false,
        ]);

        // assert response contain the token
        $this->assertResponseContainKeys(['id']);

        // assert the data is stored in the database
        $this->assertDatabaseHas('messages', [
            'title'    => $data['title'],
            'content'  => htmlspecialchars($data['content']),
            'msg_type' => $data['msg_type'],
            'is_read'  => 0,
        ]);

        $messages_count = Message::whereSender($user->name)->first()->guests->count();//group 下的用户是都有发送信息
        $this->assertEquals($messages_count, $this->group->guests->count());
    }

    public function testCreateImageMessage_()
    {

        $user = $this->getTestingUser();

        $data = [
            'title'    => $this->faker->title,
            'group_id' => $this->group->id,
            'content'  => $this->faker->word,
            'img_url'  => $this->faker->imageUrl(),
            'url'      => $this->faker->url,
            'msg_type' => 1,
        ];


        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'title'    => $data['title'],
            'content'  => $data['content'],
            'msg_type' => $this->msg_type[$data['msg_type']],
            'is_read'  => false,
        ]);

        // assert response contain the token
        $this->assertResponseContainKeys(['id']);

        // assert the data is stored in the database
        $this->assertDatabaseHas('messages', [
            'title'    => $data['title'],
            'content'  => htmlspecialchars($data['content']),
            'msg_type' => $data['msg_type'],
            'is_read'  => 0,
        ]);

        $messages_count = Message::whereSender($user->name)->first()->guests->count();//group 下的用户是都有发送信息
        $this->assertEquals($messages_count, $this->group->guests->count());
    }

}
