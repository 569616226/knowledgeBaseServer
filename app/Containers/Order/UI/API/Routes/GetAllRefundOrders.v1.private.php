<?php

/**
 * @apiGroup           Finace
 * @apiName            getAllRefundOrders
 *
 * @api                {GET} /v1/refund_orders 退款订单列表
 * @apiDescription     退款订单列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      财务角色
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('refund_orders', [
    'as'         => 'api_order_get_all_refund_orders',
    'uses'       => 'Controller@getAllRefundOrders',
    'middleware' => [
        'auth:api',
    ],
]);