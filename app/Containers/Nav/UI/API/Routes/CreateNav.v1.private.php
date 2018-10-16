<?php

/**
 * @apiGroup           Nav
 * @apiName            createNav
 *
 * @api                {POST} /v1/navs 新建分类
 * @apiDescription    新建分类
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 * @apiParam           {String}  name 分类名称
 * @apiParam           {String}  icon 分类图标
 * @apiParam           {Number}  [pid] 分类父id
 *
 * @apiUse              NavSuccessSingleResponse
 *
 */

/** @var Route $router */
$router->post('navs', [
    'as'         => 'api_nav_create_nav',
    'uses'       => 'Controller@createNav',
    'middleware' => [
        'auth:api',
    ],
]);
