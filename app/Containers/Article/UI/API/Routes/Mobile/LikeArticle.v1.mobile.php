<?php

/**
 * @apiGroup           Article
 * @apiName            updateArticle
 *
 * @api                {PATCH} /v1/articles/:id/like 文章点赞
 * @apiDescription     文章点赞
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 */

/** @var Route $router */
$router->patch('articles/{id}/like', [
    'as'         => 'api_article_like_article',
    'uses'       => 'MobileController@likeArticle',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
