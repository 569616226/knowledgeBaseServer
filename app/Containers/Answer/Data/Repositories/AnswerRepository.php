<?php

namespace App\Containers\Answer\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class AnswerRepository
 */
class AnswerRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Answer';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'          => '=',
        'name'        => 'like',
        'status'      => '=',
        'price'       => '=',
        'star'       => '=',
        // ...
    ];

}
