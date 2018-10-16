<?php

namespace App\Containers\Finace\Tasks;

use App\Containers\Finace\Data\Repositories\FinaceRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllFinacesTask extends Task
{

    private $repository;

    public function __construct(FinaceRepository $repository)
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
