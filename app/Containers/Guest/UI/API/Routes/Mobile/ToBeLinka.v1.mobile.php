<?php

/**
 * @apiGroup           Linka
 * @apiName            ToBeLinka
 *
 * @api                {POST} /v1/to_be_linka 大咖申请（个人）
 * @apiDescription      大咖申请（个人）
 *
 * @apiVersion         1.0.0
 * @apiPermission      普通用户
 *
 *
 * @apiUse  GuestSuccessSingleResponse
 */


$router->post('to_be_linka', [
    'as'         => 'api_guest_get_to_be_linka',
    'uses'       => 'MobileController@toBeLinka',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
