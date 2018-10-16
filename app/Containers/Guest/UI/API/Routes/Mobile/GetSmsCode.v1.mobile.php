<?php

/**
 * @apiGroup           Guests
 * @apiName            GetSmsCode
 *
 * @api                {POST} /v1/guests/get_sms_code 获取手机绑定验证码
 * @apiDescription     获取手机绑定验证码
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiParam           {Number}  phone  手机号码
 *
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 * {
 *
 *   'sms_code':手机绑定验证码
 *
 * }
 */


$router->post('guests/get_sms_code', [
    'as'         => 'api_guest_get_sms_code',
    'uses'       => 'MobileController@getSmsCode',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
