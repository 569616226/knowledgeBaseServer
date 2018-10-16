<?php

namespace App\Containers\Chat\UI\API\Tests\Functional;


use App\Containers\Chat\Models\Chat;
use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateChatTest extends TestCase
{

    protected $endpoint = 'post@v1/chats';

    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCreateParentChat_()
    {
        $this->getTestingGuestWithoutAccess();

        $data = [
            'content'  => 'test_chat',
            'guest_id' => $this->guest->id,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => '操作成功',
        ]);

        // assert the data is stored in the database
        $this->assertDatabaseHas('chats', [
            'content' => $data['content'],
        ]);

//        $this->assertCount(1, auth_user()->chats);
//        $this->assertCount(1, $this->guest->chats);

    }

    public function testCreateChat_()
    {
        $guest = $this->getTestingGuestWithoutAccess();

        $chat = factory(Chat::class)->create();
        $chat->guests()->attach([
            $guest->id       => ['is_sender' => 1, 'is_last' => 1, 'reciver_or_sender_id' => $this->guest->id],
            $this->guest->id => ['is_sender' => 0, 'is_last' => 1, 'reciver_or_sender_id' => $guest->id]
        ]);

        $data = [
            'content'  => 'test_chat',
            'guest_id' => $this->guest->id,
            'pid'      => $chat->id,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => '操作成功',
        ]);

        // assert the data is stored in the database
        $this->assertDatabaseHas('chats', [
            'content' => $data['content'],
        ]);

//        $this->assertCount(2, auth_user()->chats);
//        $this->assertCount(2, $this->guest->chats);

    }

}
