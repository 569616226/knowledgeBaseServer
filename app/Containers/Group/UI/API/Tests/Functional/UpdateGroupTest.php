<?php

namespace App\Containers\Group\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class UpdateGroupTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateGroupTest extends TestCase
{

    protected $endpoint = 'put@v1/groups/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-groups',
    ];

    public function testUpdateExistingGroup_()
    {

        $data = [
            'name' => 'Updated Name',
        ];

        // send the HTTP request
        $response = $this->injectId($this->group->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned Group is the updated one
        $this->assertResponseContainKeyValue([
            'object' => 'Group',
            'name'   => $data['name'],
        ]);

        // assert data was updated in the database
        $this->assertDatabaseHas('groups', ['name' => $data['name']]);
    }

    public function testUpdateNonExistingGroup_()
    {
        $data = [
            'name' => 'Updated Name',
        ];

        $fakeGroupId = 7777;

        // send the HTTP request
        $response = $this->injectId($fakeGroupId)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'status' => 'error'
        ]);
    }

    public function testUpdateExistingGroupWithoutData_()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'message' => 'The given data was invalid.'
        ]);
    }

    public function testUpdateExistingGroupWithEmptyValues()
    {
        $data = [
            'name' => '',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertValidationErrorContain([
            // messages should be updated after modifying the validation rules, to pass this test
            'name' => 'name 值不能为空',
        ]);

    }
}
