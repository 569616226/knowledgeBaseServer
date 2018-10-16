<?php

/**
 * @apiGroup           Topic
 * @apiName            updateTopic
 *
 * @api                {POST} /v1/topics/:id 更新话题
 * @apiDescription     更新话题
 *
 * @apiVersion         1.0.0
 * @apiPermission      前台认证用户
 *
 * @apiParam           {String}  title 话题标题
 * @apiParam           {String}  describe 内容
 * @apiParam           {String}  remark 备注
 * @apiParam           {Array}  need_infos 学员需要提供什么信息
 * @apiParam           {Number}  price 话题价格
 * @apiParam           {Number}  ser_time 服务时长
 * @apiParam           {Number}  ser_type 服务类型 “0：线下约见，1: 全国通话”
 *
 * @apiUse TopicSuccessSingleResponse
 */

/** @var Route $router */
$router->post('topics/{id}', [
    'as'         => 'api_topic_update_topic',
    'uses'       => 'Controller@updateTopic',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
