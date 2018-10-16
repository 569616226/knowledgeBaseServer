<?php

/**
 * @apiGroup           GuestAnswer
 * @apiName            GetAllGuestAnswer
 *
 * @api                {GET} /v1/guest_answers 我问过的问题（学员）
 * @apiDescription     我问过的问题（学员）
 *
 * @apiVersion         1.0.0
 * @apiPermission      学员
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('guest_answers', [
    'as'         => 'api_answer_get_all_guest_answer',
    'uses'       => 'Controller@getAllGuestAnswer',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
