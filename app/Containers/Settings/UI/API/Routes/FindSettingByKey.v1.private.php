<?php

/**
 * @apiGroup           Settings
 * @apiName            Find Setting
 *
 * @api                {GET} /v1/settings 设置详情
 * @apiDescription     设置详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      管理员
 * @apiParam           {String}  key
 */

$router->GET('settings', [
    'as'         => 'api_settings_get_setting_by_key',
    'uses'       => 'Controller@getSettingByKey',
    'middleware' => [
        'auth:api',
    ],
]);
