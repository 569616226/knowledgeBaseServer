<?php

/**
 * @apiGroup           Order
 * @apiName            getAllAnswerOrders
 *
 * @api                {GET} /v1/answer_orders 问答订单列表
 * @apiDescription     问答订单列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('answer_orders', [
    'as'         => 'api_order_get_all_answer_orders',
    'uses'       => 'Controller@getAllAnswerOrders',
    'middleware' => [
        'auth:api',
    ],
]);
