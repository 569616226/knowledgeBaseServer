<?php

namespace App\Containers\Message\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;

/**
 * Class GetAllMessagesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetGuestGroupMessagesTest extends TestCase
{

    protected $endpoint = 'get@v1/guest_group_messages';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testGetGuestGroupMessages_()
    {
        $guest = $this->getTestingGuestWithoutAccess();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $message_counts = $guest->messages()->where('msg_type', '!=', 0)->paginate()->count();
        // assert the returned data size is correct
        $this->assertCount($message_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }

}
