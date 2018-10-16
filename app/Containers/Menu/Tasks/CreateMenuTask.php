<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Data\Repositories\MenuRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateMenuTask extends Task
{

    private $repository;

    public function __construct(MenuRepository $repository)
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
