<?php

namespace App\Containers\Message\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class MessageRepository
 */
class MessageRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Message';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'       => '=',
        'content'  => 'like',
        'group_name'  => 'like',
        'guest_id' => '=',
        'is_read'  => '=',
        'msg_type' => '=',
        'title'    => 'like',
        'sender'   => 'like',
    ];

}
