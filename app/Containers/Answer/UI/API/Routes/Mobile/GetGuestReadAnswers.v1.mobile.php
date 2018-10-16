<?php

/**
 * @apiGroup           GuestAnswer
 * @apiName            GetGuestReadAnswer
 *
 * @api                {GET} /v1/guest_read_answers 我看过的问题（学员）
 * @apiDescription     我看过的问题（学员）
 *
 * @apiVersion         1.0.0
 * @apiPermission      学员
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('guest_read_answers', [
    'as'         => 'api_answer_guest_read_answers',
    'uses'       => 'Controller@getGuestReadAnswer',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
