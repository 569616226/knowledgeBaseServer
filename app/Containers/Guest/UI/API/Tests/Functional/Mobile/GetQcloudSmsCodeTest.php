<?php
///**
// * Created by PhpStorm.
// * User: Administrator
// * Date: 2018/4/28
// * Time: 13:53
// * 需要测试手机绑定的时候才开启，以免每次测试都会有验证码
// */
//
//namespace App\Containers\Guest\UI\API\Tests\Functional\Mobile;
//
//
//use App\Containers\Tests\TestCase;
//use Illuminate\Support\Facades\Cache;
//
//class GetQcloudSmsCodeTest extends TestCase
//{
//    protected $endpoint = 'post@v1/guests/get_sms_code';
//    protected $check_sms_code_endpoint = 'post@v1/guests/check_sms_code';
//
//
//    public function testGetQcloudSmsCodeSuccess_()
//    {
//
//        $guest = $this->getTestingGuestWithoutAccess();
//        $data = [
//            'phone' => 13412081338
//        ];
//
//        // send the HTTP request
//        $response = $this->makeCall($data);
//
//        // assert response status is correct
//        $response->assertStatus(200);
//
//        // convert JSON response string to Object
//        $responseContent = $this->getResponseContentObject();
//
//        $this->assertEquals(Cache::get($guest->open_id.'sms_code'), $responseContent->sms_code);
//
//        $data = [
//            'phone' => 13412081338,
//            'sms_code' => Cache::get($guest->open_id.'sms_code')
//        ];
//
//        // send the HTTP request
//        $response = $this->endpoint($this->check_sms_code_endpoint)->makeCall($data);
//
//        // assert response status is correct
//        $response->assertStatus(200);
//
//        // assert the returned message is correct
//        $this->assertResponseContainKeyValue([
//            'status' => true,
//            'msg' => "操作成功",
//        ]);
//    }
//
//    public function testGetQcloudSmsCodeError_()
//    {
//
//        $guest = $this->getTestingGuestWithoutAccess();
//        $data = [
//            'phone' => 13412081338
//        ];
//
//        // send the HTTP request
//        $response = $this->makeCall($data);
//
//        // assert response status is correct
//        $response->assertStatus(200);
//
//        // convert JSON response string to Object
//        $responseContent = $this->getResponseContentObject();
//
//        $this->assertEquals(Cache::get($guest->open_id.'sms_code'), $responseContent->sms_code);
//
//        $data = [
//            'phone' => 13412081338,
//            'sms_code' => 123
//        ];
//
//
//        // send the HTTP request
//        $response = $this->endpoint($this->check_sms_code_endpoint)->makeCall($data);
//
//        // assert response status is correct
//        $response->assertStatus(200);
//
//        // assert the returned message is correct
//        $this->assertResponseContainKeyValue([
//            'status' => false,
//            'msg' => "验证码错误",
//        ]);
//
//    }
//
//    public function testGetQcloudSmsCodeWithoutData_()
//    {
//
//        $this->getTestingGuestWithoutAccess();
//        // send the HTTP request
//        $response = $this->makeCall();
//
//        // assert response status is correct
//        $response->assertStatus(422);
//
//
//    }
//
//
//}