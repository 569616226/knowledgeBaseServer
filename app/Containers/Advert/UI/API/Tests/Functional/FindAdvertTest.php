<?php

namespace App\Containers\Advert\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;
use App\Containers\User\Models\User;

/**
 * Class FindAdvertsTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class FindAdvertTest extends TestCase
{

    protected $endpoint = 'get@v1/adverts/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-adverts',
    ];

    public function testFindAdverts_()
    {
        // send the HTTP request
        $response = $this->injectId($this->advert->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertEquals(User::find($this->advert->user_id)->name, $responseContent->data->user_name);
        $this->assertEquals($this->advert->name, $responseContent->data->name);
        $this->assertEquals($this->advert->path, $responseContent->data->path);
        $this->assertEquals($this->advert->url, $responseContent->data->url);
        $this->assertEquals($this->advert->type, $responseContent->data->type);
        $this->assertEquals($this->advert->order, $responseContent->data->order);
    }

}
