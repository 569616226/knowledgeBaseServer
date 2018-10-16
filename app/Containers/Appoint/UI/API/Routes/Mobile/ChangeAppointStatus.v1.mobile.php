<?php

/**
 * @apiGroup           Appoints
 * @apiName            ChangeAppointStatus
 *
 * @api                {POST} /v1/appoints/:id/change_status 约见状态修改
 * @apiDescription     约见状态修改
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机认证用户
 *
 * @apiParam           {Number}  status  约见状态 0：已关闭/取消，1：待付款 ，2：待确认 ，3：待见面，4：待评价，5：已完成，6：已拒绝
 * @apiParam           {String}  [cancel_res]  取消原因 取消订单使用
 * @apiParam           {Number}  [case_id]   用户选择的方案id
 *
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 *{
 *
 *  当status = 0/3 会生成订单 返回微信支付配置：
 *
 *  "appoint_id",
 *  "appId",
 *  "nonceStr",
 *  "package",
 *  "signType",
 *   "paySign",
 *  "timestamp",
 *
 * ==============================
 *
 *  当status 是其他值的时候 返回：
 *
 *  "status" ,
 *  "msg",
 *
 * }
 *
 */


$router->post('appoints/{id}/change_status', [
    'as'         => 'api_guest_change_appoint_status',
    'uses'       => 'Controller@changeAppointStatus',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
