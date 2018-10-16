<?php

namespace App\Containers\Appoint\Tasks;

use App\Containers\Appoint\Data\Repositories\AppointRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateAppointTask extends Task
{

    private $repository;

    public function __construct(AppointRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        try {
            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            report($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
