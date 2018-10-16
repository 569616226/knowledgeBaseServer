<?php

/**
 * @apiDefine AnswerSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 *{
 * "data":{
 *      "object":"Answer",
 *      "id":问题id,
 *      "id":问题id,
 *      "name":"问题名字",
 *      "status":"问题状态：0:待回答 ， 1：已回答，2：已关闭 3:待付款",
 *      "readers":"问题查看人数",
 *      "price":"问题金额",
 *      "linka_name":"大咖名字",
 *      "linka_id":"大咖id",
 *      "linka_hash_id":"大咖hash_id",
 *      "linka_avatar":"大咖avatar",
 *      "linka_office":"大咖office",
 *      "guest_name":"提问人",
 *      "is_see_content":"是否可以查看",
 *      "display_time":"显示时间",
 *      "readers":"查看人数",
 *      "content":"回答内容",
 *      "created_at":"2017-06-06 05:40:51",
 *      "updated_at":"2017-06-06 05:40:51",
 * },
 * "meta":{
 *    "include":[
 *       "stores",
 **       "invoices",
 *   ],
 *    "custom":[
 *
 *    ]
 * }
 *}
 */

