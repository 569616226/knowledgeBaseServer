<?php

namespace App\Containers\Nav\UI\API\Tests\Functional;

use App\Containers\Nav\Models\Nav;
use App\Containers\Tests\TestCase;

/**
 * Class DeleteUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class DeleteNavTest extends TestCase
{

    protected $endpoint = 'delete@v1/navs/{id}';

    protected $access = [
        'roles'       => '',
        'permissions' => 'manage-navs',
    ];

    public function testDeleteExistingParentNavWithoutChildNav_()
    {

        // send the HTTP request
        $response = $this->injectId($this->nav->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => "操作成功",
        ]);
    }

    public function testDeleteExistingParentNavWithChildNav_()
    {

        factory(Nav::class)->create(['pid' => $this->nav->id]);

        // send the HTTP request
        $response = $this->injectId($this->nav->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(200);

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'status' => false,
            'msg'    => '不能删除有子分类的分类',
        ]);
    }
}
