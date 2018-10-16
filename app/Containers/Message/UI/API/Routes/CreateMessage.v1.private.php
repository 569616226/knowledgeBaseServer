<?php

/**
 * @apiGroup           Message
 * @apiName            createMessage
 *
 * @api                {POST} /v1/messages 发送消息（图文/纯文本）
 * @apiDescription     发送消息（图文/纯文本）
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 * @apiParam           {String}  title 消息标题
 * @apiParam           {String}  img_url 消息图片
 * @apiParam           {Number}  group_id 用户组ID
 * @apiParam           {String}  content 消息内容
 * @apiParam           {Number}  msg_type 消息类型  0:系统消息，1:图文,2:文本
 * @apiParam           {String}  [url] 消息url
 *
 * @apiUse         MessageSuccessSingleResponse
 */

/** @var Route $router */
$router->post('messages', [
    'as'         => 'api_message_create_message',
    'uses'       => 'Controller@createMessage',
    'middleware' => [
        'auth:api',
    ],
]);
