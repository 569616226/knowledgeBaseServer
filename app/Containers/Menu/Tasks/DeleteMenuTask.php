<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Data\Repositories\MenuRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteMenuTask extends Task
{

    private $repository;

    public function __construct(MenuRepository $repository)
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
