<?php

/**
 * @apiGroup           Appoint
 * @apiName            updateAppoint
 *
 * @api                {PATCH} /v1/appoints/:id 更新约见
 * @apiDescription     更新约见
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机端认证用户
 *
 * @apiParam           {Array}  [answers]   学员提的问题
 * @apiParam           {String}  [profile]  学员自我介绍
 * @apiParam           {String}  [cancel_res]  取消原因
 * @apiParam           {String}  [canceler]  取消人
 *
 * @apiUse AppointSuccessSingleResponse
 */

/** @var Route $router */
$router->patch('appoints/{id}', [
    'as'         => 'api_appoint_update_appoint',
    'uses'       => 'Controller@updateAppoint',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
