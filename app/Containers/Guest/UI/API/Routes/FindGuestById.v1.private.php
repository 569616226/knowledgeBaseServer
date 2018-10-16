<?php

/**
 * @apiGroup           Guests
 * @apiName            Find guest
 *
 * @api                {GET} /v1/guests/:id 访问用户
 * @apiDescription      访问用户
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证后台用户
 *
 *
 * @apiUse  GuestSuccessSingleResponse
 */


$router->get('guests/{id}', [
    'as'         => 'api_guest_find_guest_by_id',
    'uses'       => 'Controller@findGuestById',
    'middleware' => [
        'auth:api',
    ],
]);
