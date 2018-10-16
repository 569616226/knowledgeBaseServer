<?php

namespace App\Containers\Group\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateGroupTest extends TestCase
{

    protected $endpoint = 'post@v1/groups';

    protected $access = [
        'permissions' => 'manage-groups',
        'roles'       => '',
    ];

    public function testCreateGroup_()
    {
        $user = $this->getTestingUser();
        $data = [
            'name' => 'test_group',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'name'      => $data['name'],
            'user_name' => $user->name,
        ]);

        // assert response contain the token
        $this->assertResponseContainKeys(['id']);

        // assert the data is stored in the database
        $this->assertDatabaseHas('groups', [
            'name'    => $data['name'],
            'user_id' => $user->id
        ]);

    }

}
