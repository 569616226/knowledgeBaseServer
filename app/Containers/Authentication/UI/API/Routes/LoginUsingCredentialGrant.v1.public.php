<?php

/**
 * @apiGroup           OAuth2
 * @apiName            凭证授权登陆
 * @api                {post} /v1/oauth/token 登陆(凭证授权登陆)
 * @apiDescription     第三方客户端，使用密码和用户名登陆。
 *                     你必须通过创建新的凭证客户端，获得你的凭证ID和密码。
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证用户
 *
 * @apiParam           {String}  client_id
 * @apiParam           {String}  client_secret
 * @apiParam           {String}  grant_type 必须是 client_credentials
 * @apiParam           {String}  [scope]  可选
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "token_type": "Bearer",
 * "expires_in": 315360000,
 * "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
 * }
 *
 *
 *  @apiErrorExample  {json}      Error-Response:
 * HTTP/1.1 400 OK
 * {
 * "status": "error",
 * "message": '账号或密码输入有误',
 * "message": '此账号已被冻结',
 *
 * }
 */

// Implementation in the Laravel Passport package
