

<?php

/**
 * @apiGroup           Message
 * @apiName            findMessageById
 *
 * @api                {GET} /v1/mobile_messages/:id 手機消息详情
 * @apiDescription     手機消息详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 * @apiUse         MessageSuccessSingleResponse
 */

/** @var Route $router */
$router->get('mobile_messages/{id}', [
    'as'         => 'api_message_find_mobile_message_by_id',
    'uses'       => 'MobileController@findMobileMessageById',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
