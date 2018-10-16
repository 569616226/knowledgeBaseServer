<?php

namespace App\Containers\Guest\Tasks;

use App\Containers\Guest\Data\Repositories\GuestRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteGuestTask extends Task
{

    private $repository;

    public function __construct(GuestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {

        try {
            return $this->repository->delete($id);
        } catch (Exception $exception) {
            report($exception);
            throw new DeleteResourceFailedException();
        }
    }
}
