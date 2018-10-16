<?php

/**
 * @apiGroup           Users
 * @apiName            FrozenAdmin
 *
 * @api                {GET} /v1/admins/frozen/{id} 切换后台用户冻结/解冻状态
 * @apiDescription     切换后台用户冻结/解冻状态
 *
 * @apiVersion         1.0.0
 * @apiPermission      admin
 *
 *
 * @apiUse  GeneralSuccessSingleResponse
 */

/** @var Route $router */
$router->get('admins/frozen/{id}', [
    'as'         => 'api_user_frozen_admin',
    'uses'       => 'Controller@frozenAdmin',
    'middleware' => [
        'auth:api',
    ],
]);
