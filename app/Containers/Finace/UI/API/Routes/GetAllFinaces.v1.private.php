<?php

/**
 * @apiGroup           Finace
 * @apiName            getAllFinaces
 *
 * @api                {GET} /v1/finaces 交易记录
 * @apiDescription     交易记录
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 *
 */

/** @var Route $router */
$router->get('finaces', [
    'as' => 'api_finace_get_all_finaces',
    'uses'  => 'Controller@getAllFinaces',
    'middleware' => [
      'auth:api',
    ],
]);
