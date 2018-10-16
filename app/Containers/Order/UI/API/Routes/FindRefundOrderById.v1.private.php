<?php

/**
 * @apiGroup           Finace
 * @apiName            findRefundOrderById
 *
 * @api                {GET} /v1/refund_orders/:id 退款审核详情
 * @apiDescription     退款审核详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 *
 * @apiUse  OrderSuccessSingleResponse
 */

/** @var Route $router */
$router->get('refund_orders/{id}', [
    'as'         => 'api_order_find_refund_order_by_id',
    'uses'       => 'Controller@findRefundOrderById',
    'middleware' => [
        'auth:api',
    ],
]);
