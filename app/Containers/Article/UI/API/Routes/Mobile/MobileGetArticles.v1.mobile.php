<?php

/**
 * @apiGroup           Article
 * @apiName            Get Article List By GuestId To Mobile
 *
 * @api                {GET} /v1/articles/mobile/list 移动端文章列表
 * @apiDescription     移动端文章列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证前端登录用户
 *
 *
 * @apiUse  ArticleSuccessSingleResponse
 */
$router->get('articles/mobile/list', [
    'as'         => 'api_article_mobile_articles',
    'uses'       => 'MobileController@mobileArticles',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
