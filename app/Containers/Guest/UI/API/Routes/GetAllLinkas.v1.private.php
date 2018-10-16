<?php

/**
 * @apiGroup           Guests
 * @apiName            GetAllLinkas
 *
 * @api                {GET} /v1/linkas 大咖列表
 * @apiDescription     大咖列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证后台用户
 *
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('linkas', [
    'as'         => 'api_guest_get_all_linkas',
    'uses'       => 'Controller@getAllLinkas',
    'middleware' => [
        'auth:api',
    ],
]);
