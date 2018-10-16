<?php

/**
 * @apiGroup           Order
 * @apiName            getAllAppointOrders
 *
 * @api                {GET} /v1/appoint_orders 约见订单列表
 * @apiDescription     约见订单列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('appoint_orders', [
    'as'         => 'api_order_get_all_appoint_orders',
    'uses'       => 'Controller@getAllAppointOrders',
    'middleware' => [
        'auth:api',
    ],
]);