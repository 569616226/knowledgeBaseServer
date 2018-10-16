<?php

/**
 * @apiGroup           AppointCase
 * @apiName            createAppointCase
 *
 * @api                {POST} /v1/appoint_cases 新建约见方案
 * @apiDescription     新建约见方案
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机端认证用户
 *
 * @apiParam           {array}  appoint_cases 约见方案名称集合
 *
 * @apiUse               AppointCaseSuccessSingleResponse
 *
 *
 */

/** @var Route $router */
$router->post('appoint_cases', [
    'as'         => 'api_appointcase_create_appoint_case',
    'uses'       => 'Controller@createAppointCase',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
