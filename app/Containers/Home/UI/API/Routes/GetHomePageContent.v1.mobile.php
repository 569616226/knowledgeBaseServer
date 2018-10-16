<?php

/**
 * @apiGroup           Home
 * @apiName            Get Homepage Data
 *
 * @api                {GET} /v1/homes 手机首页
 * @apiDescription     手机首页
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 */

/** @var Route $router */
$router->get('homes', [
    'as'         => 'api_home_get_homepage_content',
    'uses'       => 'Controller@getHomepageContent',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
