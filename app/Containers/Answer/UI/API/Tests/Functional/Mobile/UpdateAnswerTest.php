<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 13:53
 */

namespace App\Containers\Answer\UI\API\Tests\Functional\Mobile;


use App\Containers\Tests\TestCase;

class UpdateAnswerTest extends TestCase
{
    protected $endpoint = 'post@v1/answers/{id}';
    protected $access = [
        'permissions' => null,
        'roles'       => null,
    ];

    public function testUpdateAnswer_()
    {

        $this->getTestingGuestWithoutAccess();

        $data = [
            'star' => 1
        ];

        // send the HTTP request
        $response = $this->injectId($this->answer->id)->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg' => '操作成功',
        ]);

    }

}