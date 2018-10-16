<?php

namespace App\Containers\Advert\Tasks;

use App\Containers\Advert\Data\Repositories\AdvertRepository;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class DeleteAdvertTask extends Task
{

    private $repository;

    public function __construct(AdvertRepository $repository)
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
