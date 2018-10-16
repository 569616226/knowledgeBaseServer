<?php

/**
 * @apiGroup           Order
 * @apiName            findCancelOrderById
 *
 * @api                {GET} /v1/cancel_orders/:id 违约金订单详情
 * @apiDescription     违约金订单详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 *
 * @apiUse  OrderSuccessSingleResponse
 */

/** @var Route $router */
$router->get('cancel_orders/{id}', [
    'as'         => 'api_order_find_cancel_order_by_id',
    'uses'       => 'Controller@findCancelOrderById',
    'middleware' => [
        'auth:api',
    ],
]);
