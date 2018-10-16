<?php

/**
 * @apiGroup           Guests
 * @apiName            GetGuestViewedLinkas
 *
 * @api                {GET} /v1/guest_viewed_linkas 我浏览过的大咖（学员）
 * @apiDescription     我浏览过的大咖（学员）
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('guest_viewed_linkas', [
    'as'         => 'api_guest_get_guest_like_linkas',
    'uses'       => 'MobileController@getGuestViewedLinkas',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
