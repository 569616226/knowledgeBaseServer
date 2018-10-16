<?php

/**
 * @apiGroup           Order
 * @apiName            getAllCancelOrders
 *
 * @api                {GET} /v1/cancels/orders 违约金订单列表
 * @apiDescription     违约金订单列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('cancels/orders', [
    'as'         => 'api_order_get_all_cancel_orders',
    'uses'       => 'Controller@getAllCancelOrders',
    'middleware' => [
        'auth:api',
    ],
]);