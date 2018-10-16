<?php

/**
 * @apiGroup           Image
 * @apiName            UploadImage
 *
 * @api                {POST} /v1/upload_image 上传图片
 * @apiDescription      上传图片
 *
 * @apiVersion         1.0.0
 * @apiPermission      大咖用户
 *
 * @apiParam           {file}  card_pic  图片
 *
 * @apiSuccessExample {json} Success-Response:
 *HTTP/1.1 200 OK
 * {
 *
 *   'img_url':图片地址
 *
 * }
 */


$router->post('upload_image', [
    'as'         => 'api_guest_upload_image',
    'uses'       => 'MobileController@uploadImage',
    'middleware' => [
        'auth:mobile_api',
    ],
]);
