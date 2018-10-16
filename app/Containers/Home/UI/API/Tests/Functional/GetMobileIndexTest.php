<?php

namespace App\Containers\Home\UI\API\Tests\Functional;


use App\Containers\Tests\TestCase;

/**
 * Class GetAllHomesTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetMobileIndexTest extends TestCase
{

    protected $endpoint = 'get@v1/homes';

    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testGetAllHomeDatas()
    {
        $this->getTestingGuestWithoutAccess();

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        // assert the returned data size is correct
        $this->assertNotNull($responseContent->data->adverts->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
        $this->assertNotNull($responseContent->data->navs->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
        $this->assertNotNull($responseContent->data->linkas->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
        $this->assertNotNull($responseContent->data->topics->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
        $this->assertNotNull($responseContent->data->answers->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)

    }

}
