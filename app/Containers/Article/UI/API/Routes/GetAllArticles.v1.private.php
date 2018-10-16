<?php

/**
 * @apiGroup           Article
 * @apiName            getAllArticles
 *
 * @api                {GET} /v1/articles 文章列表
 * @apiDescription     文章列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('articles', [
    'as'         => 'api_article_get_all_articles',
    'uses'       => 'Controller@getAllArticles',
    'middleware' => [
        'auth:api',
    ],
]);
