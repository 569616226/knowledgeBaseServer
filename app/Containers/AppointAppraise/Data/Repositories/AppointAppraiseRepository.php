<?php

namespace App\Containers\AppointAppraise\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class AppointAppraiseRepository
 */
class AppointAppraiseRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'AppointAppraise';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'      => '=',
        'star'    => '=',
        'degree'  => '=',
        'content' => 'like',
        // ...
    ];

}
