<?php

namespace App\Containers\AppointAppraise\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppointAppraise\Data\Repositories\AppointAppraiseRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateAppointAppraiseTask extends Task
{

    private $repository;

    public function __construct(AppointAppraiseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($appoint_id, $data)
    {
        try {

            \DB::beginTransaction();

            $result =   $this->repository->create($data);

            if($result){

                Apiato::call('Appoint@UpdateAppointTask', [$appoint_id,['status' => 5]]);

                \DB::commit();

                return true;

            }else{

                \DB::rollback();
                return false;
            }


        } catch (Exception $exception) {

            \DB::rollback();
            report($exception);
            throw new CreateResourceFailedException();
        }
    }
}
