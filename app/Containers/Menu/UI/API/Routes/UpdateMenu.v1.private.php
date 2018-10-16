<?php

/**
 * @apiGroup           Menu
 * @apiName            updateMenu
 *
 * @api                {PATCH} /v1/menus/:id 编辑菜单
 * @apiDescription     编辑菜单
 *
 * @apiVersion         1.0.0
 * @apiPermission      系统管理员
 *
 * @apiParam           {String}  name 菜单名称
 * @apiParam           {String}  icon 菜单图标
 * @apiParam           {String}  url 菜单地址
 * @apiParam           {String}  [description] 菜单描述
 * @apiParam           {Number}  parent_id 菜单父id
 *
 * @apiUse  MuenSuccessSingleResponse
 */

/** @var Route $router */
$router->patch('menus/{id}', [
    'as'         => 'api_menu_update_menu',
    'uses'       => 'Controller@updateMenu',
    'middleware' => [
        'auth:api',
    ],
]);
