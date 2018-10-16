<?php

/**
 * @apiGroup           Appoint
 * @apiName            createAppoint
 *
 * @api                {POST} /v1/appoints 立即约见
 * @apiDescription     立即约见
 *
 * @apiVersion         1.0.0
 * @apiPermission      前端认证用户
 *
 * @apiParam           {Array}  [answers] 学员提的问题
 * @apiParam           {String}  [profile] 学员自我介绍
 * @apiParam           {Number}  topic_id  话题id
 *
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 *{
 *   "appId",
 *  "nonceStr",
 *  "package",
 *  "signType",
 *   "paySign",
 *  "timestamp",
 * }
 */

/** @var Route $router */
$router->post('appoints', [
    'as'         => 'api_appoint_create_appoint',
    'uses'       => 'Controller@createAppoint',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
