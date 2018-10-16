<?php

/**
 * @apiGroup           Home
 * @apiName            Search Topic Data
 *
 * @api                {POST} /v1/homes/search_topic 手机首页话题搜索
 * @apiDescription     手机首页话题搜索
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiParam           {string}  search_text 搜索文本
 */

/** @var Route $router */
$router->post('homes/search_topic', [
    'as'         => 'api_home_search_topic_content',
    'uses'       => 'Controller@searchHomeTopicContent',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
