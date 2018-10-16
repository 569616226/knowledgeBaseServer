<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Data\Repositories\MenuRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindMenuByIdTask extends Task
{

    private $repository;

    public function __construct(MenuRepository $repository)
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
