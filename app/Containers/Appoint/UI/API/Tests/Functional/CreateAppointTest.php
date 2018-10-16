<?php

namespace App\Containers\Appoint\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAppointTest extends TestCase
{

    protected $endpoint = 'post@v1/appoints';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testCreateAppoint_()
    {

        $guest = $this->getTestingGuestWithoutAccess();

        $data = [
            'topic_id' => $this->topic->id,
            'answers'  => [1, 2, 3],
            'profile'  => 'profile',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned appoint is the updated one
        $this->assertResponseContainKeyValue([
            'object'     => 'Appoint',
            'answers'    => $data['answers'],
            'profile'    => $data['profile'],
        ]);

        // assert the data is stored in the database
        $this->assertDatabaseHas('appoints', [
            'status'     => 2,
            'guest_id'   => $guest->id,
            'topic_id'   => $this->topic->id,
            'cancel_res' => null,
            'canceler'   => null,
            'answers'    => "[1,2,3]",
            'profile'    => $data['profile'],
        ]);

    }

}
