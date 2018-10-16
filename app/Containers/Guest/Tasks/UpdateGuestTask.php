<?php

namespace App\Containers\Guest\Tasks;

use App\Containers\Guest\Data\Repositories\GuestRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateGuestTask extends Task
{

    private $repository;

    public function __construct(GuestRepository $repository)
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
