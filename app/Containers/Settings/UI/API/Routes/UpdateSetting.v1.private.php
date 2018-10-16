<?php

/**
 * @apiGroup           Settings
 * @apiName            updateSetting
 *
 * @api                {PATCH} /v1/settings 更新系统设置
 * @apiDescription     更新设置
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {Array}  value 设置的值
 * @apiParam           {String}  key
 *

 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "data": {
 * "object": "Setting",
 * "id": "aadfa72342sa",
 * "key": "foo",
 * "value": "bar"
 *
 *
 * 订单设置        system_order_settings               [约见订单自动关闭时间,违约金比例,问答订单自动关闭时间]
 * 财务设置         system_take_settings                 [约见费用转入时间,问答费用转入时间,问答订单自动关闭时间]
 * 抽成设置         system_take_settings            [大咖约见抽成比例 [平台/大咖],大咖问答问题收入抽成 [平台/大咖],答案查看抽成比例 [平台/大咖/提问人]]
 * 公众号管理       system_wehchat_settings         [公众号关注回复内容设置]
 * 快速提问价格管理  system_answer_price_settings   [提问价格,查看价格]
 *
 *
 *
 * },
 * "meta": {
 * "include": [],
 * "custom": []
 * }
 * }
 */

$router->patch('settings', [
    'as'         => 'api_settings_update_setting',
    'uses'       => 'Controller@updateSetting',
    'middleware' => [
        'auth:api',
    ],
]);
