<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 13:53
 */

namespace App\Containers\Guest\UI\API\Tests\Functional\Mobile;


use App\Containers\Tests\TestCase;

class GuestLikeLinkaTest extends TestCase
{
    protected $endpoint = 'post@v1/guests/like_linka';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testGuestLikeLinkaIsLiked_()
    {

        $guest = $this->getTestingGuestWithoutAccess(['like_linkas' => [1, 2, 3], 'status' => 3]);

        $data = [
            'linka_id' => 1
        ];

        // send the HTTP request
        $response = $this->makeCall($data);


        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $linkas = push_or_pull_array_value($guest->like_linkas, $data['linka_id']);

        $this->assertEquals($linkas, $responseContent->data->like_linkas);

    }

    public function testGuestLikeLinkaIsNotLiked_()
    {

        $guest = $this->getTestingGuestWithoutAccess(['like_linkas' => [1, 2, 3], 'status' => 3]);

        $data = [
            'linka_id' => 4
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $linkas = push_or_pull_array_value($guest->like_linkas, $data['linka_id']);

        $this->assertEquals($linkas, $responseContent->data->like_linkas);

    }

}