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

class GetAllLinkasWithCheckedLinkaTest extends TestCase
{
    protected $endpoint = 'get@v1/linka_check_list';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-linkas',
    ];

    public function testGetAllLinkaCheckList_()
    {
        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $linka_counts = Guest::whereIn('status', [0, 1, 2])->count();
        // assert the returned data size is correct
        $this->assertCount($linka_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
        $this->assertFalse(in_array('普通用户', array_pluck($responseContent->data, 'status_txt')));
    }
}