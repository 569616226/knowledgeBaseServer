<?php

/**
 * @apiGroup           Guests
 * @apiName           CheckSmsCode
 *
 * @api                {POST} /v1/guests/check_sms_code 绑定手机
 * @apiDescription     绑定手机
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiParam           {Number}  phone  手机号码
 * @apiParam           {Number}  sms_code 验证码
 *
 * @apiSuccessExample {json} Success-Response:
 *  HTTP/1.1 200 OK
 * {
 *     status':true
 *     'msg':操作成功

 *    'status':false
 *    'msg':操作失败
 *
 * }
 */


$router->post('guests/check_sms_code', [
    'as'         => 'api_guest_check_sms_code',
    'uses'       => 'MobileController@checkSmsCode',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
