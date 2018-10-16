<?php

namespace App\Containers\Group\Tasks;

use App\Containers\Group\Data\Repositories\GroupRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateGroupTask extends Task
{

    private $repository;

    public function __construct(GroupRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {
        if (empty($data)) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        try {
            return $this->repository->update($data, $id);
        } catch (Exception $exception) {
            report($exception);
            throw new UpdateResourceFailedException();
        }
    }
}
