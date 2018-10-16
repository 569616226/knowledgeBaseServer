<?php

namespace App\Containers\Guest\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class GuestRepository
 */
class GuestRepository extends Repository
{

    /**
     * The Container Name.
     * Must be set when the model has a different name than the container
     */
    protected $container = 'Guest';

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'             => '=',
        'open_id'        => '=',
        'name'           => 'like',
        'phone'          => '=',
        'email'          => '=',
        'we_name'        => 'like',
        'city'           => 'like',
        'location'       => 'like',
        'card_id'        => '=',
        'avatar'         => '',
        'single_profile' => 'like',
        'office'         => 'like',
        'cover'          => '',
        'card_pic'       => '',
        'referee'        => 'like',
        'remark'         => 'like',
        'profile'        => 'like',
        'status'         => '=',
        'gender'         => '=',
        'like_linkas'    => 'like',
        'viewed_linkas'  => 'like',
    ];

}
