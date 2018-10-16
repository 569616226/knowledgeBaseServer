<?php

/**
 * @apiGroup           Linka
 * @apiName            Linka Profile
 *
 * @api                {GET} /v1/linka_profile 大咖个人信息(大咖专栏)
 * @apiDescription      大咖个人信息
 *
 * @apiVersion         1.0.0
 * @apiPermission      大咖用户
 *
 *
 * @apiUse  GuestSuccessSingleResponse
 */


$router->get('linka_profile', [
    'as'         => 'api_guest_get_linka_profile',
    'uses'       => 'MobileController@getLinkaProfile',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
