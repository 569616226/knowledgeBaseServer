<?php

/**
 * @apiGroup           Appoint
 * @apiName            getAllAppoints
 *
 * @api                {GET} /v1/appoints 约见列表
 * @apiDescription     约见列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('appoints', [
    'as'         => 'api_appoint_get_all_appoints',
    'uses'       => 'Controller@getAllAppoints',
    'middleware' => [
        'auth:api',
    ],
]);
