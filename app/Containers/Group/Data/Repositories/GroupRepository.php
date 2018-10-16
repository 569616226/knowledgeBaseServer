<?php

namespace App\Containers\Group\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class GroupRepository
 */
class GroupRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Group';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'      => '=',
        'name'    => 'like',
        'user_id' => '=',
    ];

}
