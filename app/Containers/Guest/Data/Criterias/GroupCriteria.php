<?php

namespace App\Containers\Guest\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class RoleCriteria.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GroupCriteria extends Criteria
{

    /**
     * @var string
     */
    private $groups;

    /**
     * RoleCriteria constructor.
     *
     * @param $groups
     */
    public function __construct($groups)
    {
        $this->groups = $groups;
    }

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereHas('groups', function ($q) {
            $q->where('name', $this->groups);
        });
    }
}
