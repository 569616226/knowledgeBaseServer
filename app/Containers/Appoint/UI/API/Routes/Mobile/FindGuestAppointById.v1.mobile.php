<?php

/**
 * @apiGroup           GuestAppoint
 * @apiName            findGuestAppointById
 *
 * @api                {GET} /v1/linka_appoints/:id 学员约见详情
 * @apiDescription     学员约见详情
 * @apiVersion         1.0.0
 * @apiPermission      学员
 *
 * @apiUse AppointSuccessSingleResponse
 */

/** @var Route $router */
$router->get('linka_appoints/{id}', [
    'as'         => 'api_appoint_find_guest_appoint_by_id',
    'uses'       => 'Controller@findGuestAppointById',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
