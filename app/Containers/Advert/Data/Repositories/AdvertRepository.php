<?php

namespace App\Containers\Advert\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class AdvertRepository
 */
class AdvertRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Advert';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'   => '=',
        'name' => 'like',
    ];

}
