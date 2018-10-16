<?php

/**
 * @apiDefine GuestSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 *{
 * "data":{
 *      "object":"Guest",
 *      "id":eqwja3vw94kzmxr0,
 *      "open_id":"微信open_id",
 *      "name":"用户姓名",
 *      "avatar":"用户头像",
 *      "phone":"手机",
 *      "email":"邮箱",
 *      "we_name":"微信账号",
 *      "city":"所在地",
 *      "single_profile":"一句话介绍",
 *      "office":"任职机构",
 *      "cover":"个人封面 大咖数据",
 *      "location":"所在区域 (可以选)",
 *      "card_id":"身份证号码 大咖数据",
 *      "card_pic":"手持身份证照 大咖数据",
 *      "referee":"推荐人名称 大咖数据",
 *      "remark":"备注",
 *      "auditor":"审核人",
 *      "audit_time":"审核时间",
 *      "profile":"个人介绍",
 *      "status" : 大咖审核状态 “0：失败，1：成功 ，2：待审核 ，3：普通用户”,
 *      "navs_name" : 专业领域”,
 *      "groups_name" : 用户组”,
 *      "groups_ids" : 用户组id”,
 *      "chats" : 未读私信数量”,
 *      "system_msgs" : 未读消息数量”,
 *      "gender" : 性别 "0：女 ，1：男 ，2：未知"
 *      "created_at":"2017-06-06 05:40:51",
 *      "updated_at":"2017-06-06 05:40:51",
 *      "Groups":{
 *           "data":[
 *              {
 *                 "object": "Group",
 *                 "id": abcderf,
 *                 "name":"用户组名称",
 *                 "user_name":"用户组创建人",
 *                  "created_at":"2017-06-06 05:40:51",
 *                  "updated_at":"2017-06-06 05:40:51",
 *              },
 *              {
 *                 "object": "Group",
 *                 "id": ascderf,
 *                 "name":"用户组名称",
 *                 "user_name":"用户组创建人",
 *                  "created_at":"2017-06-06 05:40:51",
 *                  "updated_at":"2017-06-06 05:40:51",
 *              }
 *           ]
 *        },
 *        "Navs":{
 *           "data":[
 *              {
 *                 "object": "Nav",
 *                 "id": abcderf,
 *                 "name":"用户组名称",
 *                 "user_name":"用户组创建人",
 *                  "created_at":"2017-06-06 05:40:51",
 *                  "updated_at":"2017-06-06 05:40:51",
 *              },
 *              {
 *                 "object": "Nav",
 *                 "id": ascderf,
 *                 "name":"用户组名称",
 *                 "user_name":"用户组创建人",
 *                  "created_at":"2017-06-06 05:40:51",
 *                  "updated_at":"2017-06-06 05:40:51",
 *              }
 *           ]
 *        }
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

