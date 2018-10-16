<?php

namespace App\Containers\Advert\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

/**
 * Class DeleteUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteAdvertTest extends TestCase
{

    protected $endpoint = 'delete@v1/adverts/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-adverts',
    ];

    public function testDeleteExistingAdvert_()
    {

        // send the HTTP request
        $response = $this->injectId($this->advert->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => "操作成功",
        ]);
    }

}
