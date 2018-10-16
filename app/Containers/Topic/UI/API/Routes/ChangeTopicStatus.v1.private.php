<?php

/**
 * @apiGroup           Topics
 * @apiName            ChangeTopicStatus
 *
 * @api                {POST} /v1/topics/:id/change_status 话题审核
 * @apiDescription     话题审核
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证用户
 *
 * @apiParam           {Number}  status  话题审核状态
 *
 * @apiUse  TopicSuccessSingleResponse
 */


$router->post('topics/{id}/change_status', [
    'as'         => 'api_guest_change_topic_status',
    'uses'       => 'Controller@changeTopicStatus',
    'middleware' => [
        'auth:api',
    ],
]);
