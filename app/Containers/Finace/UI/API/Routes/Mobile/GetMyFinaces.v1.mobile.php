<?php

/**
 * @apiGroup           Finace
 * @apiName            getMyFinaces
 *
 * @api                {GET} /v1/guest_finaces 交易记录
 * @apiDescription     交易记录
 *
 * @apiVersion         1.0.0
 * @apiPermission      手机用户
 *
 *
 */

/** @var Route $router */
$router->get('guest_finaces', [
    'as' => 'api_finace_get_my_finaces',
    'uses'  => 'Controller@getMyFinaces',
    'middleware' => [
      'auth:mobile_api',
    ],
]);
