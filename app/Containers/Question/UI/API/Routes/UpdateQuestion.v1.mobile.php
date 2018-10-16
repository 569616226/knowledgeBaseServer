<?php

/**
 * @apiGroup           Question
 * @apiName            updateQuestion
 *
 * @api                {PATCH} /v1/questions/:id 回答问题
 * @apiDescription     大咖回答问题
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  content 回答内容
 *
 * @apiSuccessExample  {json}  Success-Response:
 *HTTP/1.1 200 OK
 *{
 *  'status' : true,
 *  "msg" : "操作成功"
 *
 *
 *  'status' : false,
 *  "msg" : "操作失败"
 *
 *}
 */

/** @var Route $router */
$router->patch('questions/{id}', [
    'as'         => 'api_question_update_question',
    'uses'       => 'Controller@updateQuestion',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
