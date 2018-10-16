<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 13:53
 */

namespace App\Containers\Guest\UI\API\Tests\Functional;

use App\Containers\Guest\Models\Guest;
use App\Containers\Tests\TestCase;

class GetAllLinkasTest extends TestCase
{
    protected $endpoint = 'get@v1/linkas';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-linkas',
    ];

    public function testGetAllLinkas_()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $linka_counts = Guest::whereStatus(1)->get()->count();
        // assert the returned data size is correct
        $this->assertCount($linka_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }
}