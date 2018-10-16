<?php

/**
 * @apiGroup           Nav
 * @apiName            GetChildrenNavById
 *
 * @api                {GET} /v1/nav/:id/children 子分类
 * @apiDescription      子分类
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('nav/{id}/children', [
    'as'         => 'api_nav_get_children_nav_by_id',
    'uses'       => 'Controller@getChildrenNavById',
    'middleware' => [
        'auth:api',
    ],
]);
