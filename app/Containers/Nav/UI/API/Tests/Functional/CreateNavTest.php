<?php

namespace App\Containers\Nav\UI\API\Tests\Functional;


use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateNavTest extends TestCase
{

    protected $endpoint = 'post@v1/navs';

    protected $access = [
        'permissions' => 'manage-navs',
        'roles'       => '',
    ];

    public function testCreateParentNav_()
    {
        $user = $this->getTestingUser();
        $data = [
            'name'    => 'test_nav',
            'icon'    => 'icon_url',
            'user_id' => $user->id,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'name'      => $data['name'],
            'icon'      => $data['icon'],
            'pid'       => 0,
            'user_name' => $user->name,
        ]);

        // assert response contain the token
        $this->assertResponseContainKeys(['id']);

        // assert the data is stored in the database
        $this->assertDatabaseHas('navs', [
            'name'    => $data['name'],
            'icon'    => $data['icon'],
            'pid'     => 0,
            'user_id' => $data['user_id']
        ]);

    }

    public function testCreateNav_()
    {
        $user = $this->getTestingUser();

        $data = [
            'name'    => 'test_nav',
            'icon'    => 'icon_url',
            'pid'     => $this->nav->id,
            'user_id' => $user->id,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'name'      => $data['name'],
            'icon'      => $data['icon'],
            'pid'       => $data['pid'],
            'user_name' => $user->name,
        ]);

        // assert response contain the token
        $this->assertResponseContainKeys(['id']);

        // assert the data is stored in the database
        $this->assertDatabaseHas('navs', [
            'name'    => $data['name'],
            'icon'    => $data['icon'],
            'pid'     => $data['pid'],
            'user_id' => $data['user_id']
        ]);

    }

}
