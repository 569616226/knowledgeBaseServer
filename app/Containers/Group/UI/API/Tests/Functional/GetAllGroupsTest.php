<?php

namespace App\Containers\Group\UI\API\Tests\Functional;

use App\Containers\Group\Models\Group;
use App\Containers\Tests\TestCase;

/**
 * Class GetAllGroupsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllGroupsTest extends TestCase
{

    protected $endpoint = 'get@v1/groups';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-groups',
    ];

    public function testGetAllGroups_()
    {

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $group_counts = Group::all()->count();
        // assert the returned data size is correct
        $this->assertCount($group_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }


}
