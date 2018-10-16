<?php

/**
 * @apiGroup           Comment
 * @apiName            createComment
 *
 * @api                {POST} /v1/article/:id/comments 发表评论
 * @apiDescription     发表评论
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  content 评论内容
 *
 * @apiUse  GeneralSuccessSingleResponse
 */

/** @var Route $router */
$router->post('article/{id}/comments', [
    'as'         => 'api_comment_create_comment',
    'uses'       => 'Controller@createComment',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
