<?php

/**
 * @apiDefine TopicSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 *{
 * "data":{
 *       "object":"Topic",
 *       id": abcderf,
 *      "title": "话题标题",
 *      "describe": "服务介绍",
 *      "guest_name": '话题创建者名字',
 *      "guest_avatar": '话题创建者头像',
 *      "guest_office": '话题创建者职位',
 *      "guest_location": '话题创建者所在地',
 *      "guest_city": '话题创建者城市',
 *      "appoint_appraises": '话题评价数量',
 *      "price": 话题价格,
 *      "ser_time": "服务时长（小时）",
 *      "ser_type": 服务类型 “0：线下约见，1: 全国通话”,
 *      "need_infos": 学员需要提供什么信息(array）,
 *      "status": 状态 “0：审核失败 ，1：审核通过 ，2：待审核”,
 *      "remark": 备注,
 *      "created_at":"2017-06-06 05:40:51",
 *      "updated_at":"2017-06-06 05:40:51",
 *      "Appoints":{
 *          "object":"Appoint",
 *          id": abcderf,
 *          "cancel_res": "取消原因",
 *          "canceler":"取消人",
 *          "answers":'学员提的问题array',
 *          "profile":学员自我介绍,
 *          "guest_name":"预约创建人",
 *          "created_at":"2017-06-06 05:40:51",
 *          "updated_at":"2017-06-06 05:40:51",
 *      }
 * },
 * "meta":{
 *    "include":[
 *       "stores",
 *       "invoices",
 *    ],
 *    "custom":[
 *
 *    ]
 * }
 *}
 */

