<?php
/**
 * @apiGroup           OAuth2
 * @apiName            退出登陆
 * @api                {DELETE} /v1/logout
 * @apiDescription     退出登陆 (废除 Access Token)
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证用户
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 202 Accepted
 * {
 * "message": "Token revoked successfully."
 * }
 */
$router->delete('logout', [
    'as'         => 'api_authentication_logout',
    'uses'       => 'Controller@logout',
    'middleware' => [
        'auth:api',
    ],
]);

