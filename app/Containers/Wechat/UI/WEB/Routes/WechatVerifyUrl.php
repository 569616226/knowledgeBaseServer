<?php

/**
 * @var Route $router
 *
 * 微信认证路由
 */
\Illuminate\Support\Facades\Route::any('/wechat', [
    'as'   => 'web_wechat_verify_url',
    'uses' => 'Controller@wechatVerifyUrl',
]);
