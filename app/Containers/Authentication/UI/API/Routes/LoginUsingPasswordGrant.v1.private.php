<?php

/**
 * @apiGroup           OAuth2
 * @apiName            密码授权登陆
 * @api                {post} /v1/oauth/token 登陆（密码授权）
 * @apiDescription     第三方客户端需要使用用户名和密码登陆
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证用户
 *
 * @apiParam           {String}  username 邮箱
 * @apiParam           {String}  password 密码
 * @apiParam           {String}  client_id
 * @apiParam           {String}  client_secret
 * @apiParam           {String}  grant_type 必须为 password
 * @apiParam           {String}  [scope] 可选
 *
 * @apiSuccessExample  {json}       Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "token_type": "Bearer",
 * "expires_in": 315360000,
 * "access_token": "eyJ0eXAiOiJKV1QiLCJhbG...",
 * "refresh_token": "Oukd61zgKzt8TBwRjnasd..."
 * }
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
