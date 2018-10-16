<?php

/**
 * @apiGroup           Message
 * @apiName            getAllSystemMessages
 *
 * @api                {GET} /v1/system_messages 系统消息列表
 * @apiDescription      系统消息列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('system_messages', [
    'as'         => 'api_message_get_all_system_messages',
    'uses'       => 'Controller@getAllSystemMessages',
    'middleware' => [
        'auth:api',
    ],
]);
