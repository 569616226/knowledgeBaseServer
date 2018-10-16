<?php

/**
 * @apiGroup           Topic
 * @apiName            getAllTopics
 *
 * @api                {GET} /v1/topics 话题列表
 * @apiDescription     话题列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('topics', [
    'as'         => 'api_topic_get_all_topics',
    'uses'       => 'Controller@getAllTopics',
    'middleware' => [
        'auth:api',
    ],
]);
