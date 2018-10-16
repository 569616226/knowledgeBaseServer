<?php

namespace App\Containers\Message\UI\API\Tests\Functional;

use App\Containers\Message\Models\Message;
use App\Containers\Tests\TestCase;

/**
 * Class GetAllMessagesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllMessagesTest extends TestCase
{

    protected $endpoint = 'get@v1/messages';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-messages',
    ];

    public function testGetAllMessages_()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $message_counts = Message::where('msg_type', '!=', 0)->count();
        // assert the returned data size is correct
        $this->assertCount($message_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }

}
