<?php

namespace App\Containers\Nav\Tasks;

use App\Containers\Nav\Data\Criterias\GetChildrenNavCriteria;
use App\Containers\Nav\Data\Criterias\GetParentNavCriteria;
use App\Containers\Nav\Data\Repositories\NavRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllNavsTask extends Task
{

    private $repository;

    public function __construct(NavRepository $repository)
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

    public function parents()
    {
        $this->repository->pushCriteria(new GetParentNavCriteria());
    }

    public function children()
    {
        $this->repository->pushCriteria(new GetChildrenNavCriteria());
    }
}
