<?php

/**
 * @apiDefine GeneralSuccessMultipleResponse
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 *{
 * "data": [
 *   {
 *      "object": "Nav",
 *      "id": abcderf,
 *      "name":"菜单名称",
 *      "icon":"图标",
 *      "parent_id":"父级id",
 *      "url":"路由",
 *      "description":"描述",
 *      "is_nav":"是否在导航栏显示",
 *      "order":"排序字段",
 *      "created_at":"2017-06-06 05:40:51",
 *      "updated_at":"2017-06-06 05:40:51",
 *   },
 *  {
 *    // ...
 *  },
 *   // ...
 *],
 *"include": [
 *  "xxx",
 *  "yyy",
 *],
 *"custom": [],
 *"meta": {
 *  "pagination": {
 *    "total": x,
 *    "count": x,
 *    "per_page": x,
 *    "current_page": x,
 *    "total_pages": x,
 *    "links": []
 *  }
 *}
 *}
 */
