<?php

namespace App\Containers\Finace\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class FinaceRepository
 */
class FinaceRepository extends Repository
{

    /**
     * The Container Name.
	 * Must be set when the model has a different name than the container
	 */
    protected $container = 'Finace';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
