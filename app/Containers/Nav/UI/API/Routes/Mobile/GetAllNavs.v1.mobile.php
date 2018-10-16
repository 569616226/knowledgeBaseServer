<?php

/**
 * @apiGroup           Nav
 * @apiName            getMobileNavs
 *
 * @api                {GET} /v1/mobile_navs 手机分类列表
 * @apiDescription      手机分类列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiUse             GeneralSuccessMultipleResponse
 *
 */

/** @var Route $router */
$router->get('mobile_navs', [
    'as'         => 'api_nav_get_mobile_navs',
    'uses'       => 'MobileController@getMobileNavs',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
