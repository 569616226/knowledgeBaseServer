<?php

namespace App\Containers\Advert\Tasks;

use App\Containers\Advert\Data\Repositories\AdvertRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateAdvertTask extends Task
{

    private $repository;

    public function __construct(AdvertRepository $repository)
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
