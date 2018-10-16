<?php

namespace App\Containers\AppointAppraise\Tasks;

use App\Containers\AppointAppraise\Data\Repositories\AppointAppraiseRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateAppointAppraiseTask extends Task
{

    private $repository;

    public function __construct(AppointAppraiseRepository $repository)
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
