<?php

/**
 * @apiGroup           Menu
 * @apiName            createMenu
 *
 * @api                {POST} /v1/menus 新建菜单
 * @apiDescription     新建菜单
 *
 * @apiVersion         1.0.0
 * @apiPermission      管理员
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
$router->post('menus', [
    'as'         => 'api_menu_create_menu',
    'uses'       => 'Controller@createMenu',
    'middleware' => [
        'auth:api',
    ],
]);
