<?php

/**
 * @apiGroup           Answer
 * @apiName            getAllAnswers
 *
 * @api                {GET} /v1/answers 问题列表
 * @apiDescription     问题列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('answers', [
    'as'         => 'api_answer_get_all_answers',
    'uses'       => 'Controller@getAllAnswers',
    'middleware' => [
        'auth:api',
    ],
]);
