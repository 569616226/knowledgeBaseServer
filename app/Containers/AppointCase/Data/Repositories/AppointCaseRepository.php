<?php

namespace App\Containers\AppointCase\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class AppointCaseRepository
 */
class AppointCaseRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'AppointCase';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'         => '=',
        'name'       => 'like',
        'guest_id'   => '=',
        'appoint_id' => '=',

    ];

}
