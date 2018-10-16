<?php

/**
 * @apiGroup           Topic
 * @apiName            FindTopicArticleAnswers
 *
 * @api                {GET} /v1/topic_article_answers?page_index=1&page_count=3 约问页面（手机 ）
 * @apiDescription     约问页面（手机 ）
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiParam           {Number}  page_index 当前页码
 * @apiParam           {Number}  page_count 每页数量
 *
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 *{
 * "data":{
 *     [
 *      "object":"Topic",
 *      id": abcderf,
 *      "title": "话题标题",
 *      "describe": "服务介绍",
 *      "guest_name":'话题创建者',
 *      'guest_id' : '话题创建者id',
 *      'guest_name':'话题创建者name',
 *      'guest_office':'话题创建者office',
 *      'guest_phone':'话题创建者phone',
 *      'appoint_guest_name':'第一个约见者的名字',
 *      "price": 话题价格,
 *      "ser_time": "服务时长（小时）",
 *      "ser_type": 服务类型 “0：线下约见，1: 全国通话”,
 *      "need_infos": 学员需要提供什么信息(array）,
 *      "status": 状态 “0：审核失败 ，1：审核通过 ，2：待审核”,
 *      "remark": 备注,
 *      "created_at":"2017-06-06 05:40:51",
 *      "updated_at":"2017-06-06 05:40:51",
 *     ],
 *      [
 *      "object":"Answer",
 *      "id":问题id,
 *      "name":"问题名字",
 *      "status":"问题状态：0:待回答 ， 1：已回答，2：已关闭 3:待付款",
 *      "readers":"问题查看人数",
 *      "price":"问题金额",
 *      "guest_name":"用户名称",
 *      "created_at":"2017-06-06 05:40:51",
 *      "updated_at":"2017-06-06 05:40:51",
 *     ],
 *      [
 *      "object":"Article",
 *      "id":"ID的Hash值",
 *      "title":"文章标题",
 *      "image":"文章封面",
 *      "user_name":"文章作者",
 *      "created_at":"创建时间",
 *     ],
 *   },
 * },
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

/** @var Route $router */
$router->get('topic_article_answers', [
    'as'         => 'api_topic_find_topic_article_answers',
    'uses'       => 'Controller@findTopicArticleAnswers',
    'middleware' => [
        'auth:mobile_api',
    ],
]);