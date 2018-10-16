<?php

/**
 * @apiGroup           Chat
 * @apiName            createChat
 *
 * @api                {POST} /v1/chats 发送私信
 * @apiDescription     发送私信
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiParam           {String}  content 私信内容
 * @apiParam           {Number}  guest_id 收信人id
 * @apiParam           {Number}  pid 最新一条的私信id
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 *  "data":{
 *      "object": "Chat",
 *      "id": abcderf,
 *      "linka_name":"发送人名字",
 *      "linka_avatar":"发送人头像",
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
$router->post('chats', [
    'as'         => 'api_chat_create_chat',
    'uses'       => 'Controller@createChat',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
