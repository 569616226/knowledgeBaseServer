<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 13:53
 */

namespace App\Containers\Guest\UI\API\Tests\Functional\Mobile;


use App\Containers\Tests\TestCase;

class GetGuestLikeLinkasTest extends TestCase
{
    protected $endpoint = 'get@v1/guest_like_linkas';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];


    public function testGetGuestLikeLinkas_()
    {
        $guest = $this->getTestingGuestWithoutAccess(['like_linkas' => [$this->linka_1->id, $this->linka_2->id]]);

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $this->assertFalse(in_array('普通用户', array_pluck($responseContent->data, 'status_txt')));

        $guest_like_linka_counts = $guest->guest_like_linkas->count();
        // assert the returned data size is correct
        $this->assertCount($guest_like_linka_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }
}