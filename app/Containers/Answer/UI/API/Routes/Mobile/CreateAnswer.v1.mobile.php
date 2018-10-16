<?php

/**
 * @apiGroup           Answer
 * @apiName            createAnswer
 *
 * @api                {POST} /v1/answers 提问题
 * @apiDescription     向大咖提问
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机端认证用户
 *
 * @apiParam           {String}  name 问题标题
 * @apiParam           {Number}  price 问题金额
 * @apiParam           {Number}  linka_id 大咖用户id
 *
 * @apiSuccessExample {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 *
 * "answer_id" : 問答id
 *
 *  微信支付參數
 *  "appId",
 *  "nonceStr",
 *  "package",
 *  "signType",
 *  "paySign",
 *  "timestamp",
 * }
 */

/** @var Route $router */
$router->post('answers', [
    'as'         => 'api_answer_create_answer',
    'uses'       => 'Controller@createAnswer',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
