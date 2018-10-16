<?php

/**
 * @apiGroup           Groups
 * @apiName            Group list
 *
 * @api                {GET} /v1/groups 用户组列表
 * @apiDescription     用户组列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证后台用户
 *
 *
 * @apiUse              GeneralSuccessMultipleResponse
 */


$router->get('groups', [
    'as'         => 'api_group_get_all_groups',
    'uses'       => 'Controller@getAllGroups',
    'middleware' => [
        'auth:api',
    ],
]);
