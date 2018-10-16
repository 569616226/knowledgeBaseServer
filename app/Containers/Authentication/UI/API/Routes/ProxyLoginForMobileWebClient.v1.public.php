<?php

/**
 * @apiGroup           OAuth2
 * @apiName            手机端登陆接口
 * @api                {post} /v1/clients/web/mobile/login  手机端登陆接口 (密码授权登陆)
 * @apiDescription     用户使用用户名和openid，不需要client_id和client_secret
 *
 * @apiVersion         1.0.0
 *
 * @apiParam           {String}  name 用户名
 * @apiParam           {String}  password openid
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "token_type": "Bearer",
 * "expires_in": 315360000,
 * "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
 * }
 */
$router->post('clients/web/mobile/login', [
    'as'   => 'api_authentication_client_mobile_web_app_login_proxy',
    'uses' => 'Controller@proxyLoginForMobileWebClient',
]);
