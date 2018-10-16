<?php

/**
 * @apiGroup           LinkaAnswer
 * @apiName            GetLinkaAnswers
 *
 * @api                {GET} /v1/linka_answers 我的问题-待回答（大咖）
 * @apiDescription     我的问题-待回答（大咖）
 *
 * @apiVersion         1.0.0
 * @apiPermission      学员
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('linka_answers', [
    'as'         => 'api_answer_get_linka_answers',
    'uses'       => 'Controller@getLinkaAnswers',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
