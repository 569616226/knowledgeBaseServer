<?php

namespace App\Containers\Appoint\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Appoint\Data\Repositories\AppointRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateAppointTask extends Task
{

    private $repository;

    public function __construct(AppointRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {

            \DB::beginTransaction();

            $appoint = $this->repository->create($data);

            \DB::commit();
            return $appoint;

        } catch (Exception $exception) {

            \DB::rollback();
            report($exception);
            throw new CreateResourceFailedException();

        }
    }
}
