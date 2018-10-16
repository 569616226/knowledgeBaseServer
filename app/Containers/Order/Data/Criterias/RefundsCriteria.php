<?php

namespace App\Containers\Order\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class AdminsCriteria.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class RefundsCriteria extends Criteria
{

    /**
     * @param                                                   $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->whereIn('status', [3, 4]);
    }
}
