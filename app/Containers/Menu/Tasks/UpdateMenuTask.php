<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Data\Repositories\MenuRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateMenuTask extends Task
{

    private $repository;

    public function __construct(MenuRepository $repository)
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
