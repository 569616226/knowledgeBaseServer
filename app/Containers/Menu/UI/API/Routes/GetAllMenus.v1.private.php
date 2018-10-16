<?php

/**
 * @apiGroup           Menu
 * @apiName            getAllMenus
 *
 * @api                {GET} /v1/menus 菜单列表
 * @apiDescription     菜单列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('menus', [
    'as'         => 'api_menu_get_all_menus',
    'uses'       => 'Controller@getAllMenus',
    'middleware' => [
        'auth:api',
    ],
]);
