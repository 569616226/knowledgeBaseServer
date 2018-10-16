<?php

/**
 * @apiGroup           Nav
 * @apiName            updateNav
 *
 * @api                {PATCH} /v1/navs/:id/children 更新子分类
 * @apiDescription     更新子分类
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 * @apiParam           {Array} nav_children 多维数组

 * 'nav_children' => [
 *    ['name'=>'分类名称'，'id' => 1,'del' => false],
 *    ['id' => 1,'del' => true],
 *    ['name'=>'新建分类名称'，'id' => null,'del' => false]
 * ]
 *
 * @apiUse  GeneralSuccessSingleResponse
 */

/** @var Route $router */
$router->patch('navs/{id}/children', [
    'as'         => 'api_nav_update_children_nav',
    'uses'       => 'Controller@updateChildrenNav',
    'middleware' => [
        'auth:api',
    ],
]);
