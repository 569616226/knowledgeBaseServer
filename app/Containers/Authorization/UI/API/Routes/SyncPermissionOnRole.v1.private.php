<?php

/**
 * @apiGroup           RolePermission
 * @apiName            syncPermissionOnRole
 * @api                {post} /v1/permissions/sync 同步角色权限并更新角色用户名称
 * @apiDescription     你可以使用 permissions/sync 接口替代 `permissions/attach` 和`permissions/detach`.
 *                     接口，它会覆盖这个角色的所有权限，并更新角色用户名称.
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 * @apiParam           {String} role_id 角色 ID
 * @apiParam           {String} role_name 角色名称
 * @apiParam           {Array} permissions_ids 权限ID 或者 权限ID数组
 *
 * @apiUse             RoleSuccessSingleResponse
 */

$router->post('permissions/sync', [
    'as'         => 'api_authorization_sync_permission_on_role',
    'uses'       => 'Controller@syncPermissionOnRole',
    'middleware' => [
        'auth:api',
    ],
]);
