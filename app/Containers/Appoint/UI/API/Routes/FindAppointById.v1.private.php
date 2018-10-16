<?php

/**
 * @apiGroup           Appoint
 * @apiName            findAppointById
 *
 * @api                {GET} /v1/appoints/:id 约见详情
 * @apiDescription     约见详情
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 * @apiUse AppointSuccessSingleResponse
 */

/** @var Route $router */
$router->get('appoints/{id}', [
    'as'         => 'api_appoint_find_appoint_by_id',
    'uses'       => 'Controller@findAppointById',
    'middleware' => [
        'auth:api',
    ],
]);
