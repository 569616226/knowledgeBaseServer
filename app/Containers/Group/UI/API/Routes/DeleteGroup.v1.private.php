<?php

/**
 * @apiGroup           Groups
 * @apiName            Delete group
 *
 * @api                {DELETE} /v1/groups/:id 删除一个用户组
 * @apiDescription     删除一个用户组
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证后台用户
 *
 *
 * @apiUse  GeneralSuccessSingleResponse
 */


$router->delete('groups/{id}', [
    'as'         => 'api_group_delete_group',
    'uses'       => 'Controller@deleteGroup',
    'middleware' => [
        'auth:api',
    ],
]);
