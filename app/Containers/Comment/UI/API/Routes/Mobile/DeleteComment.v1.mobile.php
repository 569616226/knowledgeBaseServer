<?php

/**
 * @apiGroup           Comment
 * @apiName            deleteComment
 *
 * @api                {DELETE} /v1/comments/:id 评论删除
 * @apiDescription    评论删除
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *

/** @var Route $router */
$router->delete('comments/{id}', [
    'as'         => 'api_comment_delete_comment',
    'uses'       => 'Controller@deleteComment',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
