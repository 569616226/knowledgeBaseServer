<?php

/**
 * @apiGroup           Article
 * @apiName            createArticle
 *
 * @api                {POST} /v1/articles 新建文章
 * @apiDescription     新建文章
 *
 * @apiVersion         1.0.0
 * @apiPermission      大咖用户
 *
 * @apiParam           {String}  title 文章标题
 * @apiParam           {String}  cover 文章封面
 * @apiParam           {String}  content 内容
 *
 * @apiUse             ArticleSuccessSingleResponse
 */

/** @var Route $router */
$router->post('articles', [
    'as'         => 'api_article_create_article',
    'uses'       => 'MobileController@createArticle',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
