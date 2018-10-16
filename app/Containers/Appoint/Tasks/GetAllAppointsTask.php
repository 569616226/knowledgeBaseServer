<?php

namespace App\Containers\Appoint\Tasks;

use App\Containers\Appoint\Data\Repositories\AppointRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllAppointsTask extends Task
{

    private $repository;

    public function __construct(AppointRepository $repository)
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
