<?php

/**
 * @apiGroup           Order
 * @apiName            findAnswerOrderById
 *
 * @api                {GET} /v1/answer_orders/:id 问答订单详情
 * @apiDescription     问答订单详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 *
 * @apiUse  OrderSuccessSingleResponse
 */

/** @var Route $router */
$router->get('answer_orders/{id}', [
    'as'         => 'api_order_find_answer_order_by_id',
    'uses'       => 'Controller@findAnswerOrderById',
    'middleware' => [
        'auth:api',
    ],
]);
