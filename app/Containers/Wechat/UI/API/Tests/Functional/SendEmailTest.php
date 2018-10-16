<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/28
 * Time: 13:53
 */

namespace App\Containers\Wechat\UI\API\Tests\Functional;

use App\Containers\Tests\TestCase;
use App\Containers\Wechat\Mails\SendMail;
use Illuminate\Support\Facades\Mail;

class SendEmailTest extends TestCase
{
    protected $endpoint = 'post@v1/send_email';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function testSendEmailTest_()
    {
        $this->getTestingGuestWithoutAccess();

        $data = [
            'content' => '意见反馈',
        ];

        // send the HTTP request
        $response = $this->makeCall($data);

        // assert response status is correct
        $response->assertStatus(200);

        $this->assertResponseContainKeyValue([
            'status' => true,
            'msg'    => '操作成功',
        ]);

    }

}