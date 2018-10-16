<?php

/**
 * @apiGroup           Finace
 * @apiName            changeAuditStatus
 *
 * @api                {PUT} /v1/orders/audit/status/:id 订单审核（包括提现，退款）
 * @apiDescription     订单审核
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证后台用户
 *
 * @apiParam           {Number}  refund_audit_status 审核状态 0:审核失败 1：审核通过 2:待审核
 * @apiParam           {string}  refund_audit_remark 审核备注
 *
 * @apiUse  GeneralSuccessSingleResponse
 */

/** @var Route $router */
$router->put('orders/audit/status/{id}', [
    'as'         => 'api_order_change_audit_status',
    'uses'       => 'Controller@changeAuditStatus',
    'middleware' => [
        'auth:api',
    ],
]);
