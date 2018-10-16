<?php

namespace App\Containers\Question\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class QuestionRepository
 */
class QuestionRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Question';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

}
