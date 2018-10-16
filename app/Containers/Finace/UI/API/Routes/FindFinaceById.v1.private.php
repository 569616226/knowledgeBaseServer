<?php

/**
 * @apiGroup           Finace
 * @apiName            findFinaceById
 *
 * @api                {GET} /v1/finaces/:id 交易记录详情
 * @apiDescription     交易记录详情
 *
 * @apiVersion         1.0.0
 * @apiPermission      后台用户
 *
 *
 */

/** @var Route $router */
$router->get('finaces/{id}', [
    'as' => 'api_finace_find_finace_by_id',
    'uses'  => 'Controller@findFinaceById',
    'middleware' => [
      'auth:api',
    ],
]);
