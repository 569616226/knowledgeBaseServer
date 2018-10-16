<?php

/**
 * @apiGroup           Article
 * @apiName            ChangeArticleStatus
 *
 * @api                {POST} /v1/articles/:id/change_status/ 文章审核
 * @apiDescription     文章审核
 *
 * @apiVersion         1.0.0
 * @apiPermission      后端用户
 *
 * @apiParam           {Number} id 文章ID，
 * @apiParam           {Number} status 文章ID，
 * @apiParam           {String} remark 备注
 *
 * @apiUse             ArticleSuccessSingleResponse
 */
$router->post('articles/{id}/change_status', [
    'as'         => 'api_article_change_status',
    'uses'       => 'Controller@changeArticleStatus',
    'middleware' => [
        'auth:api',
    ],
]);
