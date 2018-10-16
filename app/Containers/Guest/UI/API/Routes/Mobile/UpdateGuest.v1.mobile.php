<?php

/**
 * @apiGroup           Guests
 * @apiName            Update guest
 *
 * @api                {PUT} /v1/guests/:id 更新用户和大咖
 * @apiDescription     更新用户和大咖
 *
 * @apiVersion         1.0.0
 * @apiPermission       手机端用户
 *
 * @apiParam           {String}  name  姓名
 * @apiParam           {String}  avatar  头像
 * @apiParam           {String}  phone  手机号码
 * @apiParam           {String}  email  邮箱
 * @apiParam           {String}  we_name  微信号
 * @apiParam           {String}  city  所在城市
 * @apiParam           {String}  single_profile  一句话介绍
 * @apiParam           {String}  office  任职机构
 * @apiParam           {String}  cover  简介封面
 * @apiParam           {String}  location  所在区域 (可以选)
 * @apiParam           {String}  card_id  身份证号码
 * @apiParam           {String}  referee  推荐人名称
 * @apiParam           {String}  remark  备注
 * @apiParam           {String}  card_pic  身份证手持照
 * @apiParam           {Text}  profile  个人介绍
 * @apiParam           {Array}  nav_ids  专业领域id数组
 *
 * @apiUse  GeneralSuccessSingleResponse
 */


$router->put('guests/{id}', [
    'as'         => 'api_guest_update_guest',
    'uses'       => 'MobileController@updateGuest',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
