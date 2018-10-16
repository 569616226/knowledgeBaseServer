<?php

/**
 * @apiGroup           Settings
 * @apiName            Find Setting
 *
 * @api                {GET} /v1/mobile/settings 手机设置接口
 * @apiDescription     手机设置接口
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 * @apiParam           {String}  key
 */

$router->GET('mobile/settings', [
    'as'         => 'api_settings_get_setting_by_key',
    'uses'       => 'MobileController@getSettingByKey',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
