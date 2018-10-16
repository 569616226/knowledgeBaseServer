<?php

/**
 * @apiGroup           Nav
 * @apiName            getMobileChildrenNavs
 *
 * @api                {GET} /v1/mobile_children_navs 手机子分类列表（只有子列表）
 * @apiDescription      手机子分类列表（只有子列表）
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiUse             GeneralSuccessMultipleResponse
 *
 */

/** @var Route $router */
$router->get('mobile_children_navs', [
    'as'         => 'api_nav_get_mobile_children_navs',
    'uses'       => 'MobileController@getMobileChildrenNavs',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
