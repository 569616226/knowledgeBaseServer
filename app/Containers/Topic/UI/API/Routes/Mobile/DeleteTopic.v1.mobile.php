<?php

/**
 * @apiGroup           Topic
 * @apiName            deleteTopic
 *
 * @api                {DELETE} /v1/topics/:id 删除话题
 * @apiDescription     删除话题
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机认证用户
 *
 *
 * @apiUse  GeneralSuccessSingleResponse
 */

/** @var Route $router */
$router->delete('topics/{id}', [
    'as'         => 'api_topic_delete_topic',
    'uses'       => 'Controller@deleteTopic',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
