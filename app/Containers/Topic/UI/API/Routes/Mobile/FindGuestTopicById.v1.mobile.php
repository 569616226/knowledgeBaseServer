<?php

/**
 * @apiGroup           LinkaTopic
 * @apiName            findGuestTopicById
 *
 * @api                {GET} /v1/linka_topics/:id 大咖话题详情
 * @apiDescription     大咖话题详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机认证用户
 *
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('linka_topics/{id}', [
    'as'         => 'api_topic_find_guest_topic_by_id',
    'uses'       => 'Controller@findGuestTopicById',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
