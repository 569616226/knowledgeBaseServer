<?php

namespace App\Containers\Nav\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class NavRepository
 */
class NavRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Nav';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'      => '=',
        'name'    => 'like',
        'pid'     => '=',
        'user_id' => '=',
        // ...
    ];

}
