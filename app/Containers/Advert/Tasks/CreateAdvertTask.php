<?php

namespace App\Containers\Advert\Tasks;

use App\Containers\Advert\Data\Repositories\AdvertRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateAdvertTask extends Task
{

    private $repository;

    public function __construct(AdvertRepository $repository)
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
