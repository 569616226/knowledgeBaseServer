<?php

/**
 * @apiGroup           Image
 * @apiName            UploadImage
 *
 * @api                {POST} /v1/admin/upload_image 后台上传图片
 * @apiDescription      上传图片
 *
 * @apiVersion         1.0.0
 * @apiPermission      大咖用户
 *
 * @apiParam           {file}  img_url  图片
 *
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 * {
 *
 *   'img_url':图片地址
 *
 * }
 */


$router->post('/admin/upload_image', [
    'as'         => 'api_admin_upload_image',
    'uses'       => 'Controller@adminUploadImage',
    'middleware' => [
        'auth:api',
    ],
]);
