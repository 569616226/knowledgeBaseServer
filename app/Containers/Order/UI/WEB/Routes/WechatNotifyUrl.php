<?php

/**
 * @var Route $router
 *
 * 订单回调通知路由
 */
$router->post('orders/wechat_notify_url', [
    'as'   => 'web_order_wechat_notify_url',
    'uses' => 'Controller@wechatNotifyUrl',
]);
