<?php

namespace App\Containers\Group\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class FindGroupssTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindGroupTest extends TestCase
{

    protected $endpoint = 'get@v1/groups/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-groups',
    ];

    public function testFindGroups_()
    {

        // send the HTTP request
        $response = $this->injectId($this->group->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals($this->group->name, $responseContent->data->name);
    }

}
