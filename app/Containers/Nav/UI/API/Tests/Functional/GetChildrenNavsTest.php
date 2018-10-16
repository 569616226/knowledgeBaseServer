<?php

namespace App\Containers\Nav\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class GetAllNavsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetChildrenNavsTest extends TestCase
{

    protected $endpoint = 'get@v1/nav/{id}/children';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-navs',
    ];

    public function testGetAllNavs_()
    {

        // send the HTTP request
        $response = $this->injectId($this->nav->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $children_nav_counts =$this->nav->children->count();
        // assert the returned data size is correct
        $this->assertCount($children_nav_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }


}
