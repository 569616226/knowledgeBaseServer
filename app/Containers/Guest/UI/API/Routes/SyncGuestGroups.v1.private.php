<?php

/**
 * @apiGroup           Guests
 * @apiName            Sync groups
 *
 * @api                {POST} /v1/groups/sync 设置用户组
 * @apiDescription     设置用户组
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证用户
 *
 * @apiParam           {Number} guest_id 用户ID
 * @apiParam           {Array} groups_ids 用户组ID数组
 *
 * @apiUse  GeneralSuccessSingleResponse
 */


$router->post('groups/sync', [
    'as'         => 'api_sync_guest_groups',
    'uses'       => 'Controller@syncGuestGroups',
    'middleware' => [
        'auth:api',
    ],
]);
