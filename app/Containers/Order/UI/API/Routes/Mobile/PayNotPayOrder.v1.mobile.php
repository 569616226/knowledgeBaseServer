<?php

/**
 * @apiGroup           Order
 * @apiName            PayNotPayOrder
 *
 * @api                {GET} /v1/answers/{id}/pay_not_pay_order  重新支付待支付订单
 * @apiDescription      重新支付待支付订单
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
$router->get('answers/{id}/pay_not_pay_order', [
    'as'         => 'api_order_pay_not_pay_order',
    'uses'       => 'MobileController@payNotPayOrder',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
