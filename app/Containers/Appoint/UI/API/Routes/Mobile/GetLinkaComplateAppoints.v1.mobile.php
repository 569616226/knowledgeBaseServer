<?php

/**
 * @apiGroup           GuestAppoint
 * @apiName            GetLinkaComplateAppoints
 *
 * @api                {GET} /v1/linka_appoint_complates 我的约见（大咖 完成）
 * @apiDescription      我的约见（大咖 完成）
 *
 * @apiVersion         1.0.0
 * @apiPermission      学员
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('linka_appoint_complates', [
    'as'         => 'api_appoint_get_linka_complate_appoints',
    'uses'       => 'Controller@getLinkaComplateAppoints',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
