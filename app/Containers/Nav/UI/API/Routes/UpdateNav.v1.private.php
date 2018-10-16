<?php

/**
 * @apiGroup           Nav
 * @apiName            updateNav
 *
 * @api                {PATCH} /v1/navs/:id 更新分类
 * @apiDescription     更新分类
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 * @apiParam           {String}  name 分类名称
 * @apiParam           {String}  icon 分类图标
 * @apiParam           {Number}  pid 分类父id
 *
 * @apiUse              NavSuccessSingleResponse
 */

/** @var Route $router */
$router->patch('navs/{id}', [
    'as'         => 'api_nav_update_nav',
    'uses'       => 'Controller@updateNav',
    'middleware' => [
        'auth:api',
    ],
]);
