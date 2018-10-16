<?php

namespace App\Containers\Nav\Tasks;

use App\Containers\Nav\Data\Repositories\NavRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateNavTask extends Task
{

    private $repository;

    public function __construct(NavRepository $repository)
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
