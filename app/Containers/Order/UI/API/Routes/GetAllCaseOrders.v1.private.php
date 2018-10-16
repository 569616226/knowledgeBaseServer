<?php

/**
 * @apiGroup           Finace
 * @apiName            getAllCaseOrders
 *
 * @api                {GET} /v1/case_orders 提现审核
 * @apiDescription     提现审核订单列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      财务角色
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('case_orders', [
    'as'         => 'api_order_get_all_case_orders',
    'uses'       => 'Controller@getAllCaseOrders',
    'middleware' => [
        'auth:api',
    ],
]);