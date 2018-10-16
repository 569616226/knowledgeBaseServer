<?php

/**
 * @apiGroup           GuestAppoint
 * @apiName            GetGuestAppoints
 *
 * @api                {GET} /v1/guest_complate_appoints 我预约的大咖（学员 已完成）
 * @apiDescription      我预约的大咖（学员）
 *
 * @apiVersion         1.0.0
 * @apiPermission      学员
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('guest_complate_appoints', [
    'as'         => 'api_appoint_get_guest_complate_appoints',
    'uses'       => 'Controller@getGuestComplateAppoints',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
