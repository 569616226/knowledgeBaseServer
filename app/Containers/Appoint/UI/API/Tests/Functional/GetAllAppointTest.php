<?php

namespace App\Containers\Appoint\UI\API\Tests\Functional;


use App\Containers\Appoint\Models\Appoint;
use App\Containers\Tests\TestCase;

/**
 * Class GetAllUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllAppointTest extends TestCase
{

    protected $endpoint = 'get@v1/appoints';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-appoints',
    ];

    public function testGetAllAppoints_()
    {

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $appoint_counts = Appoint::all()->count();
        // assert the returned data size is correct
        $this->assertCount($appoint_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }


}
