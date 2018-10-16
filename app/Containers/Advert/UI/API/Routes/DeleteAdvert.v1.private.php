<?php

/**
 * @apiGroup           Advert
 * @apiName            deleteAdvert
 *
 * @api                {DELETE} /v1/adverts/:id 删除广告
 * @apiDescription     删除广告
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 * @apiUse              AdvertSuccessSingleResponse
 */

/** @var Route $router */
$router->delete('adverts/{id}', [
    'as'         => 'api_advert_delete_advert',
    'uses'       => 'Controller@deleteAdvert',
    'middleware' => [
        'auth:api',
    ],
]);
