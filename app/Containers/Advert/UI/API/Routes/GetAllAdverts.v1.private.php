<?php

/**
 * @apiGroup           Advert
 * @apiName            getAllAdverts
 *
 * @api                {GET} /v1/adverts 广告列表
 * @apiDescription     广告列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('adverts', [
    'as'         => 'api_advert_get_all_adverts',
    'uses'       => 'Controller@getAllAdverts',
    'middleware' => [
        'auth:api',
    ],
]);
