<?php

/**
 * @apiGroup           Users
 * @apiName            deleteUser
 * @api                {delete} /v1/users/:id Delete User (admin, client..)
 * @apiDescription     Delete Users of any type (Admin, Client,...)
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated User
 *
 * @apiUse  GeneralSuccessSingleResponse
 */

$router->delete('users/{id}', [
    'as'         => 'api_user_delete_user',
    'uses'       => 'Controller@deleteUser',
    'middleware' => [
        'auth:api',
    ],
]);
