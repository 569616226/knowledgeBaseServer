<?php

namespace App\Containers\Guest\Tasks;

use App\Containers\Guest\Data\Criterias\GuestsCriteria;
use App\Containers\Guest\Data\Criterias\LinkaCheckListCriteria;
use App\Containers\Guest\Data\Criterias\LinkasCriteria;
use App\Containers\Guest\Data\Repositories\GuestRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Criterias\Eloquent\OrderByDescCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllGuestsTask extends Task
{

    private $repository;

    public function __construct(GuestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param bool $skipPagination
     *
     * @return  mixed
     */
    public function run($skipPagination = false)
    {
        return $skipPagination ? $this->repository->all() : $this->repository->paginate();
    }

    public function guests()
    {
        $this->repository->pushCriteria(new GuestsCriteria());
    }

    public function linkas()
    {
        $this->repository->pushCriteria(new LinkasCriteria());
    }

    public function linka_check_list()
    {
        $this->repository->pushCriteria(new LinkaCheckListCriteria());
    }

    public function ordered()
    {
        $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }

    public function withGroup($groups)
    {
        $this->repository->pushCriteria(new UserCriteria($groups));
    }

    public function filters($skip = 0, $take = 6)
    {
        $this->repository->pushCriteria(new GetPaginateRowsCriteria($skip, $take));
    }

    public function order_by_aduit_time()
    {
        return $this->repository->pushCriteria(new OrderByDescCriteria('audit_time'));
    }
}
