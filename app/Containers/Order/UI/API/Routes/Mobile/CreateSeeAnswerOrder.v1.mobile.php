<?php

/**
 * @apiGroup           Order
 * @apiName            CreateAnswerOrder
 *
 * @api                {GET} /v1/answers/{id}/create_see_answer_order  查看问题订单
 * @apiDescription      查看问题订单
 *
 * @apiVersion         1.0.0
 * @apiPermission      前端用户
 *
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 *{
 *  "answer_id" :問答ID
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
$router->get('answers/{id}/create_see_answer_order', [
    'as'         => 'api_order_create_see_answer_order',
    'uses'       => 'MobileController@createSeeAnswerOrder',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
