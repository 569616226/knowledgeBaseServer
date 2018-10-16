<?php

/**
 * @apiGroup           Nav
 * @apiName            findNavById
 *
 * @api                {GET} /v1/navs/:id 分类详情
 * @apiDescription      分类详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 *
 * @apiUse              NavSuccessSingleResponse
 */

/** @var Route $router */
$router->get('navs/{id}', [
    'as'         => 'api_nav_find_nav_by_id',
    'uses'       => 'Controller@findNavById',
    'middleware' => [
        'auth:api',
    ],
]);
