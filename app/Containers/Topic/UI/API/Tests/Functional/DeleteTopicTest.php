<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/4
 * Time: 13:52
 */

namespace App\Containers\Topic\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;

class DeleteTopicTest extends TestCase
{
    protected $endpoint = 'delete@v1/topics/{id}';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];


    public function testDeleteExistingTopic_()
    {
        $this->getTestingGuestWithoutAccess();

        // send the HTTP request
        $response = $this->injectId($this->topic->id)->makeCall();

        // assert response status is correct
        $response->assertStatus(202);

        // assert the returned message is correct
        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => "操作成功",
        ]);
    }

}