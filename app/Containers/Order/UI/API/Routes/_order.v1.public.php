<?php

/**
 * @apiDefine OrderSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "data":{
 * "object":"Order",
 * id": abcderf,
 * "name": "订单名称",
 * "order_no": "订单号",
 * "guest_name": 订单创建人,
 * "price":订单价格,
 * "pay_type": 支付方式 ： 0：微信支付,
 * "status": 状态 "0: 已关闭 ，1：已付款 ，2：待付款 , 3:退款中，4：已退款",
 * "pay_time": 支付时间,
 * "cancel_res": "违约金取消原因",
 * "payee": "违约金付款人",
 * "is_cancel": 是否是违约金订单 0：否 1：是,
 * "answer_type": 问答类型 0 :提问 1：查看问题,
 * "refund_status": 转账状态 0：转账失败 1：转账通过 2：待转账,
 * "refund_type": 退款类型 0：约见取消退款 1：问题关闭退款,
 * "refund_way": 退款方式 0：原路退回 1：微信钱包,
 * "refund_remark": 退款备注,
 * "refund_auditor": 审核人,
 * "refund_audit_status": 审核状态 0:审核失败 1：审核通过 2:待审核,
 * "refund_audit_time": 审核时间,
 * "refund_audit_remark": 审核备注,
 * "created_at":"2017-06-06 05:40:51",
 * "updated_at":"2017-06-06 05:40:51",
 * "Guest":{
 * "object":"Guest",
 * "id":eqwja3vw94kzmxr0,
 * "open_id":"微信open_id",
 * "name":"用户姓名",
 * "avatar":"用户头像",
 * "phone":"手机",
 * "email":"邮箱",
 * "we_name":"微信账号",
 * "city":"所在地",
 * "single_profile":"一句话介绍",
 * "office":"任职机构",
 * "cover":"个人封面 大咖数据",
 * "location":"所在区域 (可以选)",
 * "card_id":"身份证号码 大咖数据",
 * "card_pic":"手持身份证照 大咖数据",
 * "referee":"推荐人名称 大咖数据",
 * "remark":"备注",
 * "profile":"个人介绍",
 * "status" : 大咖审核状态 “0：失败，1：成功 ，2：待审核 ，3：普通用户”,
 * "gender" : 性别 "0：女 ，1：男 ，2：未知"
 * "created_at":"2017-06-06 05:40:51",
 * "updated_at":"2017-06-06 05:40:51",
 * }
 * },
 * "meta":{
 * "include":[
 * "stores",
 * "invoices",
 * ],
 * "custom":[
 *
 * ]
 * }
 * }
 */

