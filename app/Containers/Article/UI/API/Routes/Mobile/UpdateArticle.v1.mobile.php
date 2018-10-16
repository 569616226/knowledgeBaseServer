<?php

/**
 * @apiGroup           Article
 * @apiName            updateArticle
 *
 * @api                {PATCH} /v1/articles/:id 编辑文章
 * @apiDescription     编辑文章
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 * @apiParam           {String}  title 文章标题
 * @apiParam           {String}  cover 文章封面
 * @apiParam           {String}  content 内容
 *
 * @apiUse             ArticleSuccessSingleResponse
 */

/** @var Route $router */
$router->patch('articles/{id}', [
    'as'         => 'api_article_update_article',
    'uses'       => 'MobileController@updateArticle',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
