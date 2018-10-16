<?php

/**
 * @apiGroup           Message
 * @apiName            GetGuestSystemMessages
 *
 * @api                {GET} /v1/guest_system_messages 手机端系统消息
 * @apiDescription     手机端系统消息
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiUse         MessageSuccessSingleResponse
 */

/** @var Route $router */
$router->get('guest_system_messages', [
    'as'         => 'api_message_get_guest_system_message',
    'uses'       => 'MobileController@getGuestSystemMessages',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
