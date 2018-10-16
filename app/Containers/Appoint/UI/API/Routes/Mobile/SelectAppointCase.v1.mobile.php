<?php

/**
 * @apiGroup           Appoints
 * @apiName            SelectAppointCase
 *
 * @api                {POST} /v1/appoints/:id/select_appoint_case 学员选择约方案
 * @apiDescription     学员选择约见方案
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机认证用户
 *
 * @apiParam           {Number}  case_id  约见方案id
 *
 * @apiUse  AppointSuccessSingleResponse
 */


$router->post('appoints/{id}/select_appoint_case', [
    'as'         => 'api_guest_select_appoint_case',
    'uses'       => 'Controller@selectAppointCase',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
