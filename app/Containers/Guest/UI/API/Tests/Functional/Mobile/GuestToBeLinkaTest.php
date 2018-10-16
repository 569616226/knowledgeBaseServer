<?php

namespace App\Containers\Guest\UI\API\Tests\Functional\Mobile;


use App\Containers\Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * Class FindUsersTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GuestToBeLinkaTest extends TestCase
{

    use WithFaker;
    protected $endpoint = 'post@v1/to_be_linka';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testGuestToBeLinka_()
    {
        $guest = $this->getTestingGuestWithoutAccess(['status' => 3]);

        $data = [
            'real_name'      => $this->faker->name,
            'phone'          => 13413381448,
            'email'          => $this->faker->unique()->safeEmail,
            'city'           => $this->faker->word,
            'single_profile' => $this->faker->word,
            'office'         => $this->faker->word,
            'navs'           => [1, 2, 3],
            'location'       => $this->faker->word,
            'card_id'        => $this->faker->creditCardNumber,
            'card_pic'       => $this->faker->imageUrl(60, 60),
            'referee'        => $this->faker->word,
        ];
        // send the HTTP request
        $response = $this->injectId($guest->id)->endpoint($this->endpoint . '?include=navs')->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($data['real_name'], $responseContent->data->real_name);
        $this->assertEquals($data['phone'], $responseContent->data->phone);
        $this->assertEquals($data['email'], $responseContent->data->email);
        $this->assertEquals($data['city'], $responseContent->data->city);
        $this->assertEquals($data['single_profile'], $responseContent->data->single_profile);
        $this->assertEquals($data['office'], $responseContent->data->office);
        $this->assertEquals($data['location'], $responseContent->data->location);
        $this->assertEquals($data['card_id'], $responseContent->data->card_id);
        $this->assertEquals($data['card_pic'], $responseContent->data->card_pic);
        $this->assertEquals($data['referee'], $responseContent->data->referee);
        $this->assertEquals(2, $responseContent->data->status);

        $this->assertNotNull($responseContent->data->navs);
    }


}
