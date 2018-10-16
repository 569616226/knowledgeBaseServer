<?php

/**
 * @apiGroup           Guests
 * @apiName            Find linka
 *
 * @api                {GET} /v1/linkas/:id 大咖详情
 * @apiDescription      大咖详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 *
 * @apiUse  GuestSuccessSingleResponse
 */


$router->get('linkas/{id}', [
    'as'         => 'api_linka_find_linka_by_id',
    'uses'       => 'Controller@findLinkaById',
    'middleware' => [
        'auth:api',
    ],
]);
