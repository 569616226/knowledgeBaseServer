<?php

/**
 * @apiGroup           Menu
 * @apiName            findMenuById
 *
 * @api                {GET} /v1/menus/:id 菜单详情
 * @apiDescription     菜单详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      管理员
 *
 * @apiUse  MuenSuccessSingleResponse
 */

/** @var Route $router */
$router->get('menus/{id}', [
    'as'         => 'api_menu_find_menu_by_id',
    'uses'       => 'Controller@findMenuById',
    'middleware' => [
        'auth:api',
    ],
]);
