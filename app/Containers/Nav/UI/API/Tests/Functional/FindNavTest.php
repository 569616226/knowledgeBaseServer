<?php

namespace App\Containers\Nav\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;
use App\Containers\User\Models\User;

/**
 * Class FindNavsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindNavTest extends TestCase
{

    protected $endpoint = 'get@v1/navs/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-navs',
    ];

    public function testFindNavs_()
    {

        // send the HTTP request
        $response = $this->injectId($this->nav->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->nav->name, $responseContent->data->name);
        $this->assertEquals($this->nav->icon, $responseContent->data->icon);
        $this->assertEquals(User::find($this->nav->user_id)->name, $responseContent->data->user_name);
        $this->assertEquals($this->nav->pid, $responseContent->data->pid);
    }

}
