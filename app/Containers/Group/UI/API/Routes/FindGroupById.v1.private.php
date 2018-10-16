<?php

/**
 * @apiGroup           Groups
 * @apiName            Find group
 *
 * @api                {GET} /v1/groups/:id 访问用户组
 * @apiDescription     访问用户组
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证后台用户
 *
 * @apiUse            GroupSuccessSingleResponse
 */


$router->get('groups/{id}', [
    'as'         => 'api_group_find_group_by_id',
    'uses'       => 'Controller@findGroupById',
    'middleware' => [
        'auth:api',
    ],
]);
