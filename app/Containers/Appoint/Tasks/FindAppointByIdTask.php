<?php

namespace App\Containers\Appoint\Tasks;

use App\Containers\Appoint\Data\Repositories\AppointRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindAppointByIdTask extends Task
{

    private $repository;

    public function __construct(AppointRepository $repository)
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
