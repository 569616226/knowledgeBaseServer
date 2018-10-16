<?php

/**
 * @apiGroup           Wallt
 * @apiName            CreateCaseOrder
 *
 * @api                {POST} /v1/orders 提现
 * @apiDescription      提现
 *
 * @apiVersion         1.0.0
 * @apiPermission      前端用户
 *
 * @apiParam           {Number}  price 提现金额
 *
 * @apiSuccessExample {json} Success-Response:
 * HTTP/1.1 200 OK
 *{
 *
 *  微信支付參數
 *  "appId",
 *  "nonceStr",
 *  "package",
 *  "signType",
 *   "paySign",
 *  "timestamp",
 * }
 */

/** @var Route $router */
$router->post('orders', [
    'as'         => 'api_order_create_case_order',
    'uses'       => 'MobileController@createCaseOrder',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
