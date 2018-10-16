<?php

/**
 * @apiGroup           Finace
 * @apiName            findCaseOrderById
 *
 * @api                {GET} /v1/case_orders/:id 提现订单详情
 * @apiDescription     提现订单详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 *
 * @apiUse  OrderSuccessSingleResponse
 */

/** @var Route $router */
$router->get('case_orders/{id}', [
    'as'         => 'api_order_find_case_order_by_id',
    'uses'       => 'Controller@findCaseOrderById',
    'middleware' => [
        'auth:api',
    ],
]);
