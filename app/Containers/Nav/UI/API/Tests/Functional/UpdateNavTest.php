<?php

namespace App\Containers\Nav\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class UpdateNavTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateNavTest extends TestCase
{

    protected $endpoint = 'patch@v1/navs/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-navs',
    ];

    public function testUpdateExistingNav_()
    {

        $data = [
            'name' => 'test_nav',
            'icon' => 'icon_url',
        ];

        // send the HTTP request
        $response = $this->injectId($this->nav->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned Nav is the updated one
        $this->assertResponseContainKeyValue([
            'object' => 'Nav',
            'name'   => $data['name'],
            'icon'   => $data['icon'],
        ]);

        // assert data was updated in the database
        $this->assertDatabaseHas('navs',
            ['name' => $data['name'],
             'icon' => $data['icon'],
            ]);
    }

    public function testUpdateNonExistingNav_()
    {
        $data = [
            'name' => 'Updated Name',
        ];

        $fakeNavId = 7777;

        // send the HTTP request
        $response = $this->injectId($fakeNavId)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'status' => 'error'
        ]);
    }

    public function testUpdateExistingNavWithoutData_()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'message' => 'The given data was invalid.'
        ]);
    }

    public function testUpdateExistingNavWithEmptyValues()
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
