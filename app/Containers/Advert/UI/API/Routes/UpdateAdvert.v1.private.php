<?php

/**
 * @apiGroup           Advert
 * @apiName            updateAdvert
 *
 * @api                {PATCH} /v1/adverts/:id 广告更新
 * @apiDescription     广告更新
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 * @apiParam           {String}  name 广告名称
 * @apiParam           {String}  path 广告图片地址
 * @apiParam           {Number}  type 链接方式 0:外链，1内部跳转
 * @apiParam           {Number}  [order] 排序方式
 * @apiParam           {String}  url    图片地址
 *
 * @apiUse              AdvertSuccessSingleResponse
 */

/** @var Route $router */
$router->patch('adverts/{id}', [
    'as'         => 'api_advert_update_advert',
    'uses'       => 'Controller@updateAdvert',
    'middleware' => [
        'auth:api',
    ],
]);
