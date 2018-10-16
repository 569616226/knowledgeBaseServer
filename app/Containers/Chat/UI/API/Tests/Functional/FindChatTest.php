<?php

namespace App\Containers\Chat\UI\API\Tests\Functional;

use App\Containers\Chat\Models\Chat;
use App\Containers\Tests\TestCase;

/**
 * Class FindChatsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindChatTest extends TestCase
{

    protected $endpoint = 'get@v1/find_chats';

    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testFindChats_()
    {

        $guest = $this->getTestingGuestWithoutAccess();
        $chats = factory(Chat::class, 66)->create();

        foreach ($chats as $key => $chat) {

            $is_last = 0;

            if($key){

                $chat->pid = 0;

            } elseif ( 0< $key && $key < 64) {

                $chat->pid = $chats[$key-1]->id;

            }elseif($key = 64){

                $chat->pid = $chats[$key-1]->id;
                $is_last = 1;
            }

            $chat->save();

            $guest->chats()->attach([ $chat->id => ['is_sender' => 1,'is_last' => $is_last,'reciver_or_sender_id' => $this->linka_1->id ] ]);
            $this->linka_1->chats()->attach([ $chat->id => ['is_sender' => 0,'is_last' => $is_last,'reciver_or_sender_id' => $guest->id ] ]);

        }

        // send the HTTP request
        $response = $this->makeCall(['guest_id' => $this->linka_1->id]);

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        $this->assertCount(66, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }

}
