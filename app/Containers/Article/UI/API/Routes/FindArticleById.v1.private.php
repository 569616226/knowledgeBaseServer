<?php

/**
 * @apiGroup           Article
 * @apiName            findArticleById
 *
 * @api                {GET} /v1/articles/:id 文章详情
 * @apiDescription     文章详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 * @apiUse             ArticleSuccessSingleResponse
 */

/** @var Route $router */
$router->get('articles/{id}', [
    'as'         => 'api_article_find_article_by_id',
    'uses'       => 'Controller@findArticleById',
    'middleware' => [
        'auth:api',
    ],
]);
