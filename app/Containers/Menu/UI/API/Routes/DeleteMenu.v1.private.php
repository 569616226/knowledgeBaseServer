<?php

/**
 * @apiGroup           Menu
 * @apiName            deleteMenu
 *
 * @api                {DELETE} /v1/menus/:id 删除菜单
 * @apiDescription     删除菜单
 *
 * @apiVersion         1.0.0
 * @apiPermission      管理员
 *
 * @apiUse  GeneralSuccessSingleResponse
 */

/** @var Route $router */
$router->delete('menus/{id}', [
    'as'         => 'api_menu_delete_menu',
    'uses'       => 'Controller@deleteMenu',
    'middleware' => [
        'auth:api',
    ],
]);
