<?php

/**
 * @apiGroup           Guests
 * @apiName            GuestLikeLinka
 *
 * @api                {POST} /v1/guests/like_linka 喜欢大咖/取消
 * @apiDescription      喜欢大咖/取消
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiParam           {Number}  linka_id  大咖id
 *
 * @apiUse  GuestSuccessSingleResponse
 */


$router->post('guests/like_linka', [
    'as'         => 'api_guest_like_linka',
    'uses'       => 'MobileController@guestLikeLinka',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
