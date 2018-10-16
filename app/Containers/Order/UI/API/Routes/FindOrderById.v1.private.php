<?php

/**
 * @apiGroup           Order
 * @apiName            findOrderById
 *
 * @api                {GET} /v1/orders/:id 订单详情
 * @apiDescription     订单详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 *
 * @apiUse  OrderSuccessSingleResponse
 */

/** @var Route $router */
$router->get('orders/{id}', [
    'as'         => 'api_order_find_order_by_id',
    'uses'       => 'Controller@findOrderById',
    'middleware' => [
        'auth:api',
    ],
]);
