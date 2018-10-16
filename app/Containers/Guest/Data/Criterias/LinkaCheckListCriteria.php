<?php

namespace App\Containers\Guest\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class AdminsCriteria.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class LinkaCheckListCriteria extends Criteria
{

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('status', '!=', 3);
    }
}
