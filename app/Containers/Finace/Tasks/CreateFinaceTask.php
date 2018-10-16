<?php

namespace App\Containers\Finace\Tasks;

use App\Containers\Finace\Data\Repositories\FinaceRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateFinaceTask extends Task
{

    private $repository;

    public function __construct(FinaceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
            return $this->repository->create($data);
        } catch (Exception $exception) {
            report($exception);
            throw new CreateResourceFailedException();
        }
    }
}
