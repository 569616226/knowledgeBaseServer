<?php

/**
 * @apiGroup           Guests
 * @apiName            guest lists
 *
 * @api                {GET} /v1/guests 用户列表
 * @apiDescription     用户列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证后台用户
 *
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */


$router->get('guests', [
    'as'         => 'api_guest_get_all_guests',
    'uses'       => 'Controller@getAllGuests',
    'middleware' => [
        'auth:api',
    ],
]);
