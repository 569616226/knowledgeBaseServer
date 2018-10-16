<?php

namespace App\Containers\Comment\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class CommentRepository
 */
class CommentRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Comment';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'      => '=',
        'content' => 'like',
    ];
}
