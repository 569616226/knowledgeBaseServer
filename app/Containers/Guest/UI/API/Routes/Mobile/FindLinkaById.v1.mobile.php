<?php

/**
 * @apiGroup           Guests
 * @apiName            Find linka
 *
 * @api                {GET} /v1/mobile_linkas/:id 手機大咖详情
 * @apiDescription      手機大咖详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      手機用戶
 *
 *
 * @apiUse  GuestSuccessSingleResponse
 */


$router->get('mobile_linkas/{id}', [
    'as'         => 'api_linka_find_mobile_linka_by_id',
    'uses'       => 'MobileController@findLinkaById',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
