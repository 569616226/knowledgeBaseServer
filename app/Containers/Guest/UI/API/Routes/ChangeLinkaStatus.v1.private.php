<?php

/**
 * @apiGroup           Guests
 * @apiName            ChangeLinkaStatus
 *
 * @api                {POST} /v1/linkas/:id/change_status 大咖审核
 * @apiDescription     大咖审核
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证用户
 *
 * @apiParam           {Number}  status  大咖审核状态
 *
 * @apiUse  GuestSuccessSingleResponse
 */


$router->post('linkas/{id}/change_status', [
    'as'         => 'api_guest_change_linka_status',
    'uses'       => 'Controller@changeLinkaStatus',
    'middleware' => [
        'auth:api',
    ],
]);
