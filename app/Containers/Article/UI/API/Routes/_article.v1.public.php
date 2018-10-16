<?php

/**
 * @apiDefine ArticleSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 * "data":{
 *      "object":"Article",
 *      "id":"ID的Hash值",
 *      "title":"文章标题",
 *      "cover":"文章封面",
 *      "content":"内容",
 *      "status":"文章审核状态",
 *      "remark":"文章审核备注",
 *      "readers":"阅读量",
 *      "like":"点赞数",
 *      "auditor":"审核人",
 *      "audit_time":"审核时间",
 *      "guest_name":"文章作者",
 *      "created_at":"创建时间",
 *      "comments": {
 *          "object":"Comment",
 *          "id":eqwja3vw94kzmxr0,
 *          "comment_user":"评论人名称",
 *          "comment_user_image":"评论人头像",
 *          "content":"评论内容",
 *          "is_del":"0",
 *          "created_at":"创建时间",
 *
 *      },
 * },
 * "meta":{
 *      "include":[],
 *      "custom":[]
 * }
 * }
 */