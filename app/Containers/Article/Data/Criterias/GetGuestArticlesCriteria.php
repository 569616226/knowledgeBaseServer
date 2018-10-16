<?php

namespace App\Containers\Article\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class AdminsCriteria.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class GetGuestArticlesCriteria extends Criteria
{

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('guest_id', auth_user()->id);
    }
}
