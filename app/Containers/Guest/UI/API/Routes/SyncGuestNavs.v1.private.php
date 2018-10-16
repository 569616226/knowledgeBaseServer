<?php

/**
 * @apiGroup           Guests
 * @apiName            Sync navs
 *
 * @api                {POST} /v1/navs/sync 设置分类
 * @apiDescription     设置分类
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证用户
 *
 * @apiParam           {Number} guest_id 用户ID
 * @apiParam           {Array} navs_ids 分类ID数组
 *
 * @apiUse  GeneralSuccessSingleResponse
 */


$router->post('navs/sync', [
    'as'         => 'api_sync_guest_navs',
    'uses'       => 'Controller@syncGuestNavs',
    'middleware' => [
        'auth:api',
    ],
]);
