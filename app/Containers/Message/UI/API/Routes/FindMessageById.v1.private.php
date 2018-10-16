<?php

/**
 * @apiGroup           Message
 * @apiName            findMessageById
 *
 * @api                {GET} /v1/messages/:id 消息详情
 * @apiDescription     消息详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 * @apiUse         MessageSuccessSingleResponse
 */

/** @var Route $router */
$router->get('messages/{id}', [
    'as'         => 'api_message_find_message_by_id',
    'uses'       => 'Controller@findMessageById',
    'middleware' => [
        'auth:api',
    ],
]);
