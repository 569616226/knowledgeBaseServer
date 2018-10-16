<?php

/**
 * @apiGroup           Topic
 * @apiName            findTopicById
 *
 * @api                {GET} /v1/topics/:id 话题详情
 * @apiDescription     话题详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证后台用户
 *
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('topics/{id}', [
    'as'         => 'api_topic_find_topic_by_id',
    'uses'       => 'Controller@findTopicById',
    'middleware' => [
        'auth:api',
    ],
]);
