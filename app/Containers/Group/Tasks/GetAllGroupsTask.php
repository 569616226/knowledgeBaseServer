<?php

namespace App\Containers\Group\Tasks;

use App\Containers\Group\Data\Repositories\GroupRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllGroupsTask extends Task
{

    private $repository;

    public function __construct(GroupRepository $repository)
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
}
