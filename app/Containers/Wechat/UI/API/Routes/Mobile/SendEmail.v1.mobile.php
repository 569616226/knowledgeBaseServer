<?php

/**
 * @apiGroup           Email
 * @apiName            sendEmail
 *
 * @api                {POST} /v1/send_email 服务建议（发送邮件）
 * @apiDescription     服务建议（发送邮件）
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机登录用户
 *
 * @apiParam           {String}  content 建议内容
 *
 * @apiUse TopicSuccessSingleResponse
 */

/** @var Route $router */
$router->post('send_email', [
    'as'         => 'api_send_email',
    'uses'       => 'Controller@sendEmail',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
