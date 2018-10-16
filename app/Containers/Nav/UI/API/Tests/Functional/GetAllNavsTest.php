<?php

namespace App\Containers\Nav\UI\API\Tests\Functional;

use App\Containers\Nav\Models\Nav;
use App\Containers\Tests\TestCase;

/**
 * Class GetAllNavsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllNavsTest extends TestCase
{

    protected $endpoint = 'get@v1/navs';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-navs',
    ];

    public function testGetAllNavs_()
    {

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $nav_counts = Nav::where('pid',0)->get()->count();
        // assert the returned data size is correct
        $this->assertCount($nav_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }


}
