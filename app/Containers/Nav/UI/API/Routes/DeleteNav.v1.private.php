<?php

/**
 * @apiGroup           Nav
 * @apiName            deleteNav
 *
 * @api                {DELETE} /v1/navs/:id 删除分类
 * @apiDescription     删除分类
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 * @apiUse  GeneralSuccessSingleResponse
 */

/** @var Route $router */
$router->delete('navs/{id}', [
    'as'         => 'api_nav_delete_nav',
    'uses'       => 'Controller@deleteNav',
    'middleware' => [
        'auth:api',
    ],
]);
