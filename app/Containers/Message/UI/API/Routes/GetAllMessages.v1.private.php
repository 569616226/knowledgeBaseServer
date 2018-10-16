<?php

/**
 * @apiGroup           Message
 * @apiName            getAllMessages
 *
 * @api                {GET} /v1/messages 群发消息列表
 * @apiDescription     群发消息列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('messages', [
    'as'         => 'api_message_get_all_messages',
    'uses'       => 'Controller@getAllMessages',
    'middleware' => [
        'auth:api',
    ],
]);
