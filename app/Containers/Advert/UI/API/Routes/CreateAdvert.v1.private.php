<?php

/**
 * @apiGroup           Advert
 * @apiName            createAdvert
 *
 * @api                {POST} /v1/adverts 新建广告
 * @apiDescription     新建广告
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
$router->post('adverts', [
    'as'         => 'api_advert_create_advert',
    'uses'       => 'Controller@createAdvert',
    'middleware' => [
        'auth:api',
    ],
]);
