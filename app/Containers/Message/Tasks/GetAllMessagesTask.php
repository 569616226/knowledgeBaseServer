<?php

namespace App\Containers\Message\Tasks;

use App\Containers\Message\Data\Criterias\GroupsCriteria;
use App\Containers\Message\Data\Criterias\SystemCriteria;
use App\Containers\Message\Data\Repositories\MessageRepository;
use App\Ship\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Ship\Parents\Tasks\Task;

class GetAllMessagesTask extends Task
{

    private $repository;

    public function __construct(MessageRepository $repository)
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

    public function system()
    {
        return $this->repository->pushCriteria(new SystemCriteria());
    }

    public function groups()
    {
        return $this->repository->pushCriteria(new GroupsCriteria());
    }


    public function ordered()
    {
        return $this->repository->pushCriteria(new OrderByCreationDateDescendingCriteria());
    }
}
