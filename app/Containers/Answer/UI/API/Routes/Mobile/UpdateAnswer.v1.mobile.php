<?php

/**
 * @apiGroup           Answers
 * @apiName            ChangeAnswerStatus
 *
 * @api                {POST} /v1/answers/:id 问题评价
 * @apiDescription     问题评价
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机认证用户
 *
 * @apiParam           {Number}  star  评分
 *
 * @apiUse  AnswerSuccessSingleResponse
 */


$router->post('answers/{id}', [
    'as'         => 'api_guest_update_answer',
    'uses'       => 'Controller@updateAnswer',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
