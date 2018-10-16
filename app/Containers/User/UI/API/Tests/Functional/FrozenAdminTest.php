<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 14:14
 */

namespace App\Containers\User\UI\API\Tests\Functional;


use App\Containers\User\Models\User;
use App\Containers\User\Tests\TestCase;

class FrozenAdminTest extends TestCase
{
    protected $endpoint = 'get@v1/admins/frozen/{id}';

    protected $access = [
        'permissions' => 'frozen-users',
        'roles'       => 'admin',
    ];

    public function testFrozenAdmin_()
    {
        $admin = factory(User::class)->create();

        $response = $this->injectId($admin->id)->makeCall();

        $response->assertStatus(200);

        $responseContent = $this->getResponseContentObject();

        $this->assertNotEquals($admin->is_frozen, $responseContent->data->is_frozen);
    }
}