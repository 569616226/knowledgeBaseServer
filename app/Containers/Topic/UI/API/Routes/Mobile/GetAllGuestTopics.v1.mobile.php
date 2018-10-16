<?php

/**
 * @apiGroup           LinkaTopic
 * @apiName            GetAllGuestTopic
 *
 * @api                {GET} /v1/linka_topics 大咖话题列表
 * @apiDescription     大咖话题列表
 *
 * @apiVersion         1.0.0
 * @apiPermission      大咖认证客户
 *
 * @apiUse  GeneralSuccessMultipleResponse
 */

/** @var Route $router */
$router->get('linka_topics', [
    'as'         => 'api_topic_get_all_guest_topic',
    'uses'       => 'Controller@GetAllGuestTopic',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
