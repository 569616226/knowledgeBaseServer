<?php

/**
 * @apiGroup           Advert
 * @apiName            findAdvertById
 *
 * @api                {GET} /v1/adverts/:id 广告详情
 * @apiDescription     广告详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 *
 * @apiUse              AdvertSuccessSingleResponse
 */

/** @var Route $router */
$router->get('adverts/{id}', [
    'as'         => 'api_advert_find_advert_by_id',
    'uses'       => 'Controller@findAdvertById',
    'middleware' => [
        'auth:api',
    ],
]);
