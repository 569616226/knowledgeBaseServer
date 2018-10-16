<?php

namespace App\Containers\Advert\UI\API\Tests\Functional;


use App\Containers\Tests\TestCase;

/**
 * Class CreateAdminTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class CreateAdvertTest extends TestCase
{

    protected $endpoint = 'post@v1/adverts';

    protected $access = [
        'permissions' => 'manage-adverts',
        'roles'       => '',
    ];

    public function testCreateAdvert_()
    {
        $user = $this->getTestingUser();
        $data = [
            'name'  => $this->faker->name,
            'path'  => $this->faker->imageUrl(),
            'type'  => random_int(0, 1),
            'order' => $this->faker->randomNumber(),
            'url'   => $this->faker->url,
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'name'      => $data['name'],
            'path'      => $data['path'],
            'type'      => $data['type'],
            'order'     => $data['order'],
            'url'       => $data['url'],
            'user_name' => $user->name,
        ]);

        // assert response contain the token
        $this->assertResponseContainKeys(['id']);

        // assert the data is stored in the database
        $this->assertDatabaseHas('adverts', [
            'name'    => $data['name'],
            'path'    => $data['path'],
            'type'    => $data['type'],
            'order'   => $data['order'],
            'url'     => $data['url'],
            'user_id' => $user->id,
        ]);

    }

}
