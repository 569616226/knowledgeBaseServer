<?php

namespace App\Containers\Advert\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

/**
 * Class AdminsCriteria.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class ReaderStatusCriteria extends Criteria
{
    private $readStatus;

    public function __construct($status)
    {
        $this->readStatus = $status;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('is_read', '=', $this->readStatus);
    }
}
