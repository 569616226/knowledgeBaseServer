<?php

namespace App\Containers\Guest\UI\API\Tests\Functional\Mobile;

use App\Containers\Tests\TestCase;

/**
 * Class UpdateGuestTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UpdateGuestTest extends TestCase
{

    protected $endpoint = 'put@v1/guests/{id}';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testUpdateExistingGuest_()
    {

        $this->getTestingGuestWithoutAccess();

        $data = [
            'name'           => $this->faker->name,
            'real_name'      => $this->faker->name,
            'avatar'         => $this->faker->imageUrl(60, 60),
            'phone'          => 13413381448,
            'email'          => $this->faker->unique()->safeEmail,
            'we_name'        => $this->faker->name,
            'city'           => $this->faker->word,
            'single_profile' => $this->faker->word,
            'office'         => $this->faker->word,
            'cover'          => $this->faker->imageUrl(60, 60),
            'location'       => $this->faker->word,
            'card_id'        => $this->faker->creditCardNumber,
            'card_pic'       => $this->faker->imageUrl(60, 60),
            'referee'        => $this->faker->word,
            'remark'         => $this->faker->word,
            'profile'        => $this->faker->word,
            'gender'         => $this->faker->numberBetween(0, 2),
        ];

        // send the HTTP request
        $response = $this->injectId($this->guest->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        // assert returned guest is the updated one
        $this->assertResponseContainKeyValue([
            'object'         => 'Guest',
            'name'           => $data['name'],
            'real_name'      => $data['real_name'],
            'avatar'         => $data['avatar'],
            'phone'          => $data['phone'],
            'email'          => $data['email'],
            'we_name'        => $data['we_name'],
            'city'           => $data['city'],
            'single_profile' => $data['single_profile'],
            'office'         => $data['office'],
            'cover'          => $data['cover'],
            'location'       => $data['location'],
            'card_id'        => $data['card_id'],
            'card_pic'       => $data['card_pic'],
            'referee'        => $data['referee'],
            'remark'         => $data['remark'],
            'profile'        => $data['profile'],
            'gender'         => $data['gender'],

        ]);

        // assert data was updated in the database
        $this->assertDatabaseHas('guests', [
            'name'           => $data['name'],
            'real_name'      => $data['real_name'],
            'avatar'         => $data['avatar'],
            'phone'          => $data['phone'],
            'email'          => $data['email'],
            'we_name'        => $data['we_name'],
            'city'           => $data['city'],
            'single_profile' => $data['single_profile'],
            'office'         => $data['office'],
            'cover'          => $data['cover'],
            'location'       => $data['location'],
            'card_id'        => $data['card_id'],
            'card_pic'       => $data['card_pic'],
            'referee'        => $data['referee'],
            'remark'         => $data['remark'],
            'profile'        => $data['profile'],
            'gender'         => $data['gender'],
        ]);
    }

    public function testUpdateNonExistingGuest_()
    {
        $data = [
            'name' => '英小俊_test',
        ];
        $this->getTestingGuestWithoutAccess();

        $fakeGuestId = 7777;

        // send the HTTP request
        $response = $this->injectId($fakeGuestId)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'status' => 'error'
        ]);
    }

    public function testUpdateExistingGuestWithoutData_()
    {
        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(422);

        $this->assertResponseContainKeyValue([
            'message' => 'The given data was invalid.'
        ]);
    }

}
