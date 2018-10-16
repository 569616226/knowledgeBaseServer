<?php

/**
 * @apiGroup           RolePermission
 * @apiName            getAllMenus
 *
 * @api                {POST} /v1/menus/role/sync 设角色菜单
 * @apiDescription       设角色菜单
 *
 * @apiVersion         1.0.0
 * @apiPermission      系统管理
 *
 *
 * @apiParam           {String} role_id 角色id
 * @apiParam           {Array} menu_ids 菜单id array
 *
 * @apiUse             GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->post('menus/role/sync', [
    'as'         => 'api_menu_sync_role_menus',
    'uses'       => 'Controller@syncRoleMenus',
    'middleware' => [
        'auth:api',
    ],
]);
