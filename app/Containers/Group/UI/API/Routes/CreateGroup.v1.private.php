<?php

/**
 * @apiGroup           Groups
 * @apiName            Create group
 *
 * @api                {POST} /v1/groups  创建一个用户组
 * @apiDescription     创建一个用户组
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证后台用户
 *
 * @apiParam           {String}  name 名称
 *
 * @apiUse  GroupSuccessSingleResponse
 */


$router->post('groups', [
    'as'         => 'api_group_create_group',
    'uses'       => 'Controller@createGroup',
    'middleware' => [
        'auth:api',
    ],
]);
