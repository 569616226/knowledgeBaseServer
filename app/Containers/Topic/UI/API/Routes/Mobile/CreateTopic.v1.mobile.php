<?php

/**
 * @apiGroup           Topic
 * @apiName            createTopic
 *
 * @api                {POST} /v1/topics 新建话题
 * @apiDescription     新建话题
 *
 * @apiVersion         1.0.0
 * @apiPermission      大咖
 *
 * @apiParam           {String}  title 话题标题
 * @apiParam           {String}  describe 服务介绍
 * @apiParam           {Number}  price 话题价格
 * @apiParam           {Number}  ser_type 服务类型 “0：线下约见，1: 全国通话”
 * @apiParam           {Number}  ser_time 服务时长（小时）
 * @apiParam           {Array}  need_infos 学员需要提供什么信息(array）
 *
 * @apiUse TopicSuccessSingleResponse
 */

/** @var Route $router */
$router->post('topics', [
    'as'         => 'api_topic_create_topic',
    'uses'       => 'Controller@createTopic',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
