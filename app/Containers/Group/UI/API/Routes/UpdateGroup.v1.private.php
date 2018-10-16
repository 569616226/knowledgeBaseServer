<?php

/**
 * @apiGroup           Groups
 * @apiName            Update group
 *
 * @api                {PUT} /v1/groups/:id 更新用户组
 * @apiDescription     更新用户组
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证后台用户
 *
 * @apiParam           {String}  name 名称
 *
 * @apiUse  GeneralSuccessSingleResponse
 */


$router->put('groups/{id}', [
    'as'         => 'api_group_update_group',
    'uses'       => 'Controller@updateGroup',
    'middleware' => [
        'auth:api',
    ],
]);
