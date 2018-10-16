<?php

/**
 * @apiGroup           Chat
 * @apiName            getAllChats
 *
 * @api                {GET} /v1/chats 私信记录列表
 * @apiDescription     私信记录列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 *  "data":{
 *      "object": "Chat",
 *      "id": abcderf,
 *      "guest_name":"发送人名字",
 *      "guest_avatar":"发送人头像",
 *      "content":"私信内
 *
 * ",
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
$router->get('chats', [
    'as'         => 'api_chat_get_all_chats',
    'uses'       => 'Controller@getAllChats',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
