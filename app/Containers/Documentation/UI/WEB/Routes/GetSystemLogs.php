<?php

/**
 * @var Route $router
 *
 * 订单回调通知路由
 */
$router->get('logs', [
    'as'   => 'get_system_logs',
    'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index',
]);
