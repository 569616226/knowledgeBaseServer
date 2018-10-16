<?php

/**
 * @apiGroup           OAuth2
 * @apiName            后台管理端登陆接口
 * @api                {post} /v1/clients/web/admin/login 登陆 (密码授权登陆)
 * @apiDescription     用户使用用户名和密码登陆，不需要client_id和client_secret
 *
 * @apiVersion         1.0.0
 *
 * @apiParam           {String}  name 用户名
 * @apiParam           {String}  password 密码
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "token_type": "Bearer",
 * "expires_in": 315360000,
 * "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
 * "refresh_token": "ZFDPA1S7H8Wydjkjl+xt+hPGWTagX..."
 * }
 */
$router->post('clients/web/admin/login', [
    'as'   => 'api_authentication_client_admin_web_app_login_proxy',
    'uses' => 'Controller@proxyLoginForAdminWebClient',
]);
