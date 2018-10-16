<?php

/**
 * @apiGroup           Nav
 * @apiName            findAnswersById
 *
 * @api                {GET} /v1/navs/:id/answers?order_by=&limit=&page= 分类下的问题信息
 * @apiDescription      分类下的问题信息
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiParam           {Number}  [order_by] 列表排序 默认排序0：1人气最高,2评分最高
 * @apiParam           {Number}  [limit] 每页个数
 * @apiParam           {Number}  [page] 页码
 *
 *@apiSuccessExample {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "data":{
 *      "object": "Answer",
 *      "id": abcderf,
 *      "guest_name":'大咖名字',
        "guest_avatar":"大咖头像",
        "guest_office":'大咖职位',
        "readers":'查看人数',
        "star":'问题评分',
        "price":'查看价格',
        "is_read":'是否查看',
 *      "created_at":"2017-06-06 05:40:51",
 *      "updated_at":"2017-06-06 05:40:51",
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

/** @var Route $router */
$router->get('navs/{id}/answers', [
    'as'         => 'api_nav_get_nav_answers_by_id',
    'uses'       => 'MobileController@findNavAnswersById',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
