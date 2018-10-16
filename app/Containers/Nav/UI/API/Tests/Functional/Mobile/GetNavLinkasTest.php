<?php

namespace App\Containers\Nav\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class FindNavsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetNavLinkasTest extends TestCase
{

    protected $endpoint = 'get@v1/navs/{id}/linkas';

    protected $access = [
        'roles'       => null,
        'permissions' => null,
    ];

    /*默认*/
    public function testFindNavLinkas_()
    {

        $this->getTestingGuestWithoutAccess();
        // send the HTTP request
        $response = $this->injectId($this->nav->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertCount(3, $responseContent->data);
    }

}
