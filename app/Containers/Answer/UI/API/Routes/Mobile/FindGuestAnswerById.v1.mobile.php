<?php

/**
 * @apiGroup           GuestAnswer
 * @apiName            FindGuestAnswerById
 *
 * @api                {GET} /v1/guest_answers/:id 我问过/看过的问题详情（学员/大咖）
 * @apiDescription     我问过/看过的问题详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      学员
 *
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 *
 *{
 *  "object":"Answer",
 *  "id":问题id,
 *  "name":"问题名字",
 *  "status":"问题状态：0:待回答 ， 1：已回答，2：已关闭 3：待付款",
 *  "readers":"问题查看人頭像",
 *  "price":"问题金额",
 *  "linka_name":大咖名字,
 *  "linka_avatar":大咖頭像,
 *  "linka_office":大咖職位,
 *  "is_guest":能否評價問題,
 *  "is_see_content":是否可以看答案,
 *  "star":問答評價,
 *  "content":問題回答,
 * }
 *
 *{
 *   "appId",
 *  "nonceStr",
 *  "package",
 *  "signType",
 *   "paySign",
 *  "timestamp",
 * }
 */

/** @var Route $router */
$router->get('guest_answers/{id}', [
    'as'         => 'api_answer_find_guest_answer_by_id',
    'uses'       => 'Controller@findGuestAnswerById',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
