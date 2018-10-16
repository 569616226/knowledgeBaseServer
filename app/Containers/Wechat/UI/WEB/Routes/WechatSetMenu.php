<?php

/**
 * @var Route $router
 *
 * 设置菜单
 */
\Illuminate\Support\Facades\Route::get('/wechat/set_menu', [
    'as'   => 'web_wechat_set_menu',
    'uses' => 'Controller@setWechatMenu',
]);
