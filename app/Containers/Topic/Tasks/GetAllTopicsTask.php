<?php

namespace App\Containers\Topic\Tasks;

use App\Containers\Topic\Data\Criterias\LinkasCriteria;
use App\Containers\Topic\Data\Repositories\TopicRepository;
use App\Ship\Criterias\Eloquent\OrderByDescCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllTopicsTask extends Task
{

    private $repository;

    public function __construct(TopicRepository $repository)
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

    public function linkas()
    {
        return $this->repository->pushCriteria(new LinkasCriteria());
    }

    public function order_by_updated_at()
    {
        return $this->repository->pushCriteria(new OrderByDescCriteria('updated_at'));
    }
}
