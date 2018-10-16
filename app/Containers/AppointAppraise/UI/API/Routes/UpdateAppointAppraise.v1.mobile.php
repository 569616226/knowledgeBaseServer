<?php

/**
 * @apiGroup           Appoint
 * @apiName            updateAppointAppraise
 *
 * @api                {PATCH} /v1/appoint_appraises/:id 评价大咖约见服务编辑
 * @apiDescription     评价大咖约见服务编辑
 *
 * @apiVersion         1.0.0
 * @apiPermission      认证学员
 *
 * @apiParam           {String}   content 评论内容
 * @apiParam           {Number}   star 行业专业度
 * @apiParam           {Number}   degree 内容满意
 *
 * @apiUse               AppointCaseSuccessSingleResponse
 */

/** @var Route $router */
$router->patch('appoint_appraises/{id}', [
    'as'         => 'api_appoint_appraises_update_appoint_appraise',
    'uses'       => 'Controller@updateAppointAppraise',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
