<?php

/**
 * @apiGroup           Guests
 * @apiName            GetAllLinkaCheckList
 *
 * @api                {GET} /v1/linka_check_list 大咖审核列表
 * @apiDescription     大咖审核列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证后台用户
 *
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('linka_check_list', [
    'as'         => 'api_guest_get_all_linkas_check_list',
    'uses'       => 'Controller@getAllLinkaCheckList',
    'middleware' => [
        'auth:api',
    ],
]);
