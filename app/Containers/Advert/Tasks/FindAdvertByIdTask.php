<?php

namespace App\Containers\Advert\Tasks;

use App\Containers\Advert\Data\Repositories\AdvertRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindAdvertByIdTask extends Task
{

    private $repository;

    public function __construct(AdvertRepository $repository)
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
