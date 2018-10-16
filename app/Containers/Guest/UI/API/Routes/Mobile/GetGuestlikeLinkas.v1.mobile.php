<?php

/**
 * @apiGroup           Guests
 * @apiName            Get|GuestLikeLinkas
 *
 * @api                {GET} /v1/guest_like_linkas 我喜欢的大咖（学员）
 * @apiDescription     我喜欢的大咖（学员）
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('guest_like_linkas', [
    'as'         => 'api_guest_get_guest_like_linkas',
    'uses'       => 'MobileController@getGuestLikeLinkas',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
