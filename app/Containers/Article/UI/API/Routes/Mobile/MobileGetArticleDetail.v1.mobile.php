<?php

/**
 * @apiGroup           Article
 * @apiName            Get Article Detail To Mobile
 *
 * @api                {GET} /v1/articles/mobile/detail/:id 移动端根据文章ID获取文章详情
 * @apiDescription     移动端根据文章ID获取文章详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证前端登录用户
 *
 * @apiParam           {String}  id 文章ID
 *
 * @apiUse  ArticleSuccessSingleResponse
 */

$router->get('articles/mobile/detail/{id}', [
    'as'         => 'api_article_mobile_article_detail',
    'uses'       => 'MobileController@mobileArticleDetail',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
