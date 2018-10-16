<?php

namespace App\Containers\Advert\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;
use App\Containers\User\Models\User;

/**
 * Class UpdateAdvertTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateAdvertTest extends TestCase
{

    protected $endpoint = 'patch@v1/adverts/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-adverts',
    ];

    public function testUpdateExistingAdvert_()
    {


        $data = [
            'name'  => $this->faker->name,
            'path'  => $this->faker->imageUrl(),
            'type'  => random_int(0, 1),
            'order' => $this->faker->randomNumber(),
            'url'   => $this->faker->url,
        ];

        // send the HTTP request
        $response = $this->injectId($this->advert->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned Advert is the updated one
        $this->assertResponseContainKeyValue([
            'name'      => $data['name'],
            'path'      => $data['path'],
            'type'      => $data['type'],
            'order'     => $data['order'],
            'url'       => $data['url'],
            'user_name' => User::find($this->advert->user_id)->name,
        ]);

        // assert data was updated in the database
        $this->assertDatabaseHas('adverts',
            [
                'name'    => $data['name'],
                'path'    => $data['path'],
                'type'    => $data['type'],
                'order'   => $data['order'],
                'url'     => $data['url'],
                'user_id' => User::find($this->advert->user_id)->id,
            ]);
    }

    public function testUpdateNonExistingAdvert_()
    {
        $data = [
            'name' => 'Updated Name',
        ];

        $fakeAdvertId = 7777;

        // send the HTTP request
        $response = $this->injectId($fakeAdvertId)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'status' => 'error'
        ]);
    }

    public function testUpdateExistingAdvertWithoutData_()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'message' => 'The given data was invalid.'
        ]);
    }

    public function testUpdateExistingAdvertWithEmptyValues()
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
