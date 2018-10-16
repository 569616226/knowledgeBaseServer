<?php

namespace App\Containers\Menu\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateMenuTest extends TestCase
{

    protected $endpoint = 'post@v1/menus';

    protected $access = [
        'permissions' => 'manage-menus',
        'roles'       => '',
    ];

    public function testCreateMenu_()
    {
        $data = [
            'name'        => '菜单名称',
            'parent_id'   => 0,
            'icon'        => 'icon',
            'url'         => 'url',
            'description' => 'description',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'name'        => $data['name'],
            'parent_id'   => $data['parent_id'],
            'url'         => $data['url'],
        ]);

        // assert response contain the token
        $this->assertResponseContainKeys(['id']);

        // assert the data is stored in the database
        $this->assertDatabaseHas('menus', [
            'name'        => $data['name'],
            'parent_id'   => $data['parent_id'],
            'icon'        => $data['icon'],
            'url'         => $data['url'],
            'description' => $data['description'],
        ]);

    }

}
