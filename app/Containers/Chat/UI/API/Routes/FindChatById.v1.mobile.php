<?php

/**
 * @apiGroup           Chat
 * @apiName            findChatById
 *
 * @api                {GET} /v1/find_chats 私信记录
 * @apiDescription     私信记录
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiParam           {Number}  guest_id 收信人id
 *
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 *  "data":{
 *      "object": "Chat",
 *      "id": abcderf,
 *      "guest_name":"发送人名字",
 *      "guest_avatar":"发送人头像",
 *      "guest_id":"发送人id",
 *      "content":"私信内容",
 *      "parent_id":"父ID",
 *      "created_at":"2017-06-06 05:40:51",
 *      "updated_at":"2017-06-06 05:40:51",
 *   },
 * "meta":{
 *    "include":[
 *       "reciver",
 *       "sender",
 *    ],
 *    "custom":[
 *
 *    ]
 * }
 * }
 */

/** @var Route $router */
$router->get('find_chats', [
    'as'         => 'api_chat_find_chat_by_id',
    'uses'       => 'Controller@findChatById',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
