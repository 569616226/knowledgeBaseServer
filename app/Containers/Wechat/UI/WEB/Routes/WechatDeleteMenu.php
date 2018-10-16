<?php

/**
 * @var Route $router
 *
 * 删除菜单
 */
\Illuminate\Support\Facades\Route::get('/wechat/delete_menu/{id?}', [
    'as'   => 'web_wechat_delete_menu',
    'uses' => 'Controller@deleteWechatMenu',
]);
