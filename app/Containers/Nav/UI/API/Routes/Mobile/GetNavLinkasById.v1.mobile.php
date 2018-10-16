<?php

/**
 * @apiGroup           Nav
 * @apiName            getNavLinkasById
 *
 * @api                {GET} /v1/navs/:id/linkas 分类下的大咖信息
 * @apiDescription      分类下的大咖信息
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机认证用户

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
$router->get('navs/{id}/linkas', [
    'as'         => 'api_nav_get_nav_linkas_by_id',
    'uses'       => 'MobileController@getNavLinkasById',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
