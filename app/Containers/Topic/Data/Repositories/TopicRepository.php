<?php

namespace App\Containers\Topic\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class TopicRepository
 */
class TopicRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Topic';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'         => '=',
        'guest_id'   => '=',
        'title'      => 'like',
        'describe'   => 'like',
        'price'      => '=',
        'status'     => '=',
        'ser_type'   => '=',
        'ser_time'   => '=',
        'need_infos' => 'like',
        'remark'     => 'like',
    ];

}
