<?php

/**
 * @apiGroup           LinkaAnswer
 * @apiName            GetLinkaHasQuestionAnswers
 *
 * @api                {GET} /v1/linka_has_question_answers 我的问题-完成（大咖）
 * @apiDescription     我的问题-完成（大咖）
 *
 * @apiVersion         1.0.0
 * @apiPermission      学员
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('linka_has_question_answers', [
    'as'         => 'api_answer_get_linka_answers',
    'uses'       => 'Controller@getLinkaHasQuestionAnswers',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
