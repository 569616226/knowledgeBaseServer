<?php

namespace App\Containers\Message\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class AdminsCriteria.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GroupsCriteria extends Criteria
{

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('msg_type', '!=', 0);
    }
}
