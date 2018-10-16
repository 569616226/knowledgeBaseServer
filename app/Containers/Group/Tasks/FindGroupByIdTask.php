<?php

namespace App\Containers\Group\Tasks;

use App\Containers\Group\Data\Repositories\GroupRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindGroupByIdTask extends Task
{

    private $repository;

    public function __construct(GroupRepository $repository)
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
