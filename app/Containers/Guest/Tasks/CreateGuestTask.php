<?php

namespace App\Containers\Guest\Tasks;

use App\Containers\Guest\Data\Repositories\GuestRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateGuestTask extends Task
{

    private $repository;

    public function __construct(GuestRepository $repository)
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
