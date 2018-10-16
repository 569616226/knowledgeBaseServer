<?php

namespace App\Containers\Advert\UI\API\Tests\Functional;

use App\Containers\Advert\Models\Advert;
use App\Containers\Tests\TestCase;

/**
 * Class GetAllAdvertsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetAllAdvertsTest extends TestCase
{

    protected $endpoint = 'get@v1/adverts';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-adverts',
    ];

    public function testGetAllAdverts_()
    {

        // send the HTTP request
        $response = $this->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // convert JSON response string to Object
        $responseContent = $this->getResponseContentObject();

        $advert_counts = Advert::all()->count();
        // assert the returned data size is correct
        $this->assertCount($advert_counts, $responseContent->data); // 2 (fake in this test) + 1 (that is logged in) + 1 (seeded super admin)
    }


}
