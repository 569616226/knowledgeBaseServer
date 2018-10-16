<?php

namespace App\Containers\User\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

/**
 * Class UserRepository.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class UserRepository extends Repository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'       => 'like',
        'id'         => '=',
        'email'      => '=',
        'is_frozen'  => '=',
        'confirmed'  => '=',
        'created_at' => 'like',
    ];

}
