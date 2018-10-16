<?php

/**
 * @apiGroup           Message
 * @apiName            GetGuestGroupMessages
 *
 * @api                {GET} /v1/guest_group_messages 手机端群发消息
 * @apiDescription     手机端群发消息
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiUse         MessageSuccessSingleResponse
 */

/** @var Route $router */
$router->get('guest_group_messages', [
    'as'         => 'api_message_get_guest_group_message',
    'uses'       => 'MobileController@getGuestGroupMessages',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
