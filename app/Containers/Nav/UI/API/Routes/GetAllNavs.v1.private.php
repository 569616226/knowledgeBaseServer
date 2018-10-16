<?php

/**
 * @apiGroup           Nav
 * @apiName            getAllNavs
 *
 * @api                {GET} /v1/navs 分类列表
 * @apiDescription    分类列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 * @apiUse              GeneralSuccessMultipleResponse
 *
 */

/** @var Route $router */
$router->get('navs', [
    'as'         => 'api_nav_get_all_navs',
    'uses'       => 'Controller@getAllNavs',
    'middleware' => [
        'auth:api',
    ],
]);
