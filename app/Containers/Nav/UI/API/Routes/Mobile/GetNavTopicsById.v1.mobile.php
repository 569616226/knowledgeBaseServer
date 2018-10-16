<?php

/**
 * @apiGroup           Nav
 * @apiName            getNavAnsewersById
 *
 * @api                {GET} /v1/navs/:id/topics?ser_type=&?order_by=&limit=&page= 分类下的话题信息
 * @apiDescription      分类下的话题信息
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *

 * @apiParam           {Number}  [ser_type] 服务类型 默认：1全国通话，0线下约见
 * @apiParam           {Number}  [order_by] 列表排序 默认排序0：1人气最高,2最新预约,3价格最低
 * @apiParam           {Number}  [limit] 每页个数
 * @apiParam           {Number}  [page] 页码
 *
 *@apiSuccessExample {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "data":{
 *      "object": "Guest",
 *      "id": abcderf,
 *      "real_name":"大咖名称",
 *      "avatar":"大咖头像",
 *      "office":"大咖职位",
 *      "helps":"帮助人数",
 *      "appraises":"评价人数",
 *      "price":"话题价格",
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
$router->get('navs/{id}/topics', [
    'as'         => 'api_nav_get_nav_topics_by_id',
    'uses'       => 'MobileController@findNavTopicsById',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
