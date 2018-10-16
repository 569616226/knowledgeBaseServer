<?php

namespace App\Containers\Finace\Tasks;

use App\Containers\Finace\Data\Repositories\FinaceRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindFinaceByIdTask extends Task
{

    private $repository;

    public function __construct(FinaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {
            return $this->repository->find($id);
        }
        catch (Exception $exception) {
            report($exception);
            throw new NotFoundException();
        }
    }
}
