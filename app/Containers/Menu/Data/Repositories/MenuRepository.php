<?php

namespace App\Containers\Menu\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class MenuRepository
 */
class MenuRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Menu';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'          => '=',
        'name'        => 'like',
        'parent_id'   => '=',
        'icon'        => 'like',
        'url'         => 'like',
        'description' => 'like',
        // ...
    ];

}
