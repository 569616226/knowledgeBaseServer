<?php

/**
 * @apiGroup           Answer
 * @apiName            findAnswerById
 *
 * @api                {GET} /v1/answers/:id 问题详情
 * @apiDescription     问题详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台认证用户
 *
 * @apiUse              AnswerSuccessSingleResponse
 */

/** @var Route $router */
$router->get('answers/{id}', [
    'as'         => 'api_answer_find_answer_by_id',
    'uses'       => 'Controller@findAnswerById',
    'middleware' => [
        'auth:api',
    ],
]);
