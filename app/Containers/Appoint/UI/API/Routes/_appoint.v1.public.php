<?php

/**
 * @apiDefine AppointSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 *{
 *  "data":{
 *  "object":"Appoint",
 *  id": abcderf,
 *  "status":"约见状态"
 *  "status_times":"约见状态,对应时间"
 *  "cancel_res": "取消原因",
 *  "canceler":"取消人",
 *   "answers":'学员提的问题array',
 *  "profile": 学员自我介绍,
 *  "guest_name": "预约创建人",
 *  "created_at":"2017-06-06 05:40:51",
 *  "updated_at":"2017-06-06 05:40:51",
 *  "AppointCase":{
 *      "object":"AppointCase",
 *      "id":eqwja3vw94kzmxr0,
 *      "name":"约见方案名称",
 *      "appoint_time":"约见方案时间",
 *      "location":"约见地点，全国通话没有地点",
 *      "created_at":"2017-06-06 05:40:51",
 *      "updated_at":"2017-06-06 05:40:51",
 *      }
 *  },
 *"meta":{
 *"include":[
 *"stores",
 *"invoices",
 *],
 *"custom":[
 *
 *]
 *}
 *}
 */

