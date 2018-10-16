<?php

namespace App\Containers\Chat\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class ChatRepository
 */
class ChatRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Chat';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        'pid' => '=',
        'is_read' => '=',
        'content' => 'like',
        // ...
    ];

}
