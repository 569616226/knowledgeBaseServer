<?php

/**
 * @apiGroup           GuestAppoint
 * @apiName            GetLinkaNoComplateAppoints
 *
 * @api                {GET} /v1/linka_appoint_no_complates 我的约见（大咖 未完成）
 * @apiDescription      我的约见（大咖 未完成）
 *
 * @apiVersion         1.0.0
 * @apiPermission      学员
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('linka_appoint_no_complates', [
    'as'         => 'api_appoint_get_linka_no_complate_appoints',
    'uses'       => 'Controller@getLinkaNoComplateAppoints',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
