<?php

namespace App\Containers\Menu\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class UpdateMenuTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateMenuTest extends TestCase
{

    protected $endpoint = 'patch@v1/menus/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-menus',
    ];

    public function testUpdateExistingMenu_()
    {

        $data = [
            'name'        => '菜单名称',
            'parent_id'   => 0,
            'icon'        => 'icon',
            'url'         => 'url',
            'description' => 'description',
        ];

        // send the HTTP request
        $response = $this->injectId($this->menu->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned Menu is the updated one
        $this->assertResponseContainKeyValue([
            'object'      => 'Menu',
            'name'        => $data['name'],
            'parent_id'   => $data['parent_id'],
            'url'         => $data['url'],
        ]);

        // assert data was updated in the database
        $this->assertDatabaseHas('menus', ['name' => $data['name']]);
    }

    public function testUpdateNonExistingMenu_()
    {
        $data = [
            'name' => 'Updated Name',
        ];

        $fakeMenuId = 7777;

        // send the HTTP request
        $response = $this->injectId($fakeMenuId)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'status' => 'error'
        ]);
    }

    public function testUpdateExistingMenuWithoutData_()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'message' => 'The given data was invalid.'
        ]);
    }

    public function testUpdateExistingMenuWithEmptyValues()
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
