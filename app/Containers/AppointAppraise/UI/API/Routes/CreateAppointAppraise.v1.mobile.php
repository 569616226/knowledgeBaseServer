<?php

/**
 * @apiGroup           Appoint
 * @apiName            createAppointAppraise
 *
 * @api                {POST} /v1/appoint_appraises:id 评价大咖约服务
 * @apiDescription     评价大咖约见服务
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证学员
 *
 * @apiParam           {String}   content 评论内容
 * @apiParam           {Number}   star 行业专业度
 * @apiParam           {Number}   degree 内容满意
 * @apiParam           {Number}   id 约见id
 *
 *
 * @apiUse               AppointCaseSuccessSingleResponse
 */

/** @var Route $router */
$router->post('appoint_appraises/{id}', [
    'as'         => 'api_appointappraise_create_appoint_appraise',
    'uses'       => 'Controller@createAppointAppraise',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
