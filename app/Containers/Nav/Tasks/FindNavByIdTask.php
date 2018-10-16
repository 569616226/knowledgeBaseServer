<?php

namespace App\Containers\Nav\Tasks;

use App\Containers\Nav\Data\Repositories\NavRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindNavByIdTask extends Task
{

    private $repository;

    public function __construct(NavRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {

            return $this->repository->find($id);

        } catch (Exception $exception) {

            report($exception);
            throw new NotFoundException();

        }
    }
}
