<?php

/**
 * @apiGroup           Home
 * @apiName            Search Answer Data
 *
 * @api                {POST} /v1/homes/search_answer 手机首页问题搜索
 * @apiDescription     手机首页问题搜索
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiParam           {string}  search_text 搜索文本
 */

/** @var Route $router */
$router->post('homes/search_answer', [
    'as'         => 'api_home_search_answer_content',
    'uses'       => 'Controller@searchHomepageContent',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
