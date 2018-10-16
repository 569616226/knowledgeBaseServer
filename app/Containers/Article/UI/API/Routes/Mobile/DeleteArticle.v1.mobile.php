<?php

/**
 * @apiGroup           Article
 * @apiName            deleteArticle
 *
 * @api                {DELETE} /v1/articles/:id 删除文章
 * @apiDescription     删除文章
 *
 * @apiVersion         1.0.0
 * @apiPermission      大咖用户
 *
 *
 * @apiUse  GeneralSuccessSingleResponse
 */

/** @var Route $router */
$router->delete('articles/{id}', [
    'as'         => 'api_article_delete_article',
    'uses'       => 'MobileController@deleteArticle',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
