<?php

/**
 * @apiDefine MessageSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "data":{
 *      "object": "Message",
 *      "id": abcderf,
 *      "sender":"消息发送者",
 *      "title":"消息标题",
 *      "content":"消息内容",
 *      "img_url":"消息图片",
 *      "is_read":"是否已读",
 *      "msg_type":"消息类型 0:系统消息，1:图文,2:文本",
 *      "created_at":"2017-06-06 05:40:51",
 *      "updated_at":"2017-06-06 05:40:51",
 *
 *   },
 * "meta":{
 *    "include":[
 *       "stores",
 *       "invoices",
 *    ],
 *    "custom":[
 *
 *    ]
 * }
 *}
 */

