<?php

namespace App\Containers\Guest\UI\API\Tests\Functional;

use App\Containers\Guest\Models\Guest;
use App\Containers\Tests\TestCase;

/**
 * Class GetAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllGuestsTest extends TestCase
{

    protected $endpoint = 'get@v1/guests';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-guests',
    ];

    public function testGetAllGuests_()
    {

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $guest_counts = Guest::whereStatus(3)->get()->count();
        // assert the returned data size is correct
        $this->assertCount($guest_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)

        $this->assertEquals(['普通用户'], array_unique(array_pluck($responseContent->data, 'status_txt')));

    }


}
