<?php

namespace App\Containers\AppointCase\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppointCase\Data\Repositories\AppointCaseRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Carbon\Carbon;
use Exception;

class CreateAppointCaseTask extends Task
{

    private $repository;

    public function __construct(AppointCaseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $datas)
    {
        try {

            \DB::beginTransaction();

            $create_appoint_case = null;

            foreach($datas  as $appoint_case){

                $appoint_case['appoint_time'] =  Carbon::createFromFormat('Y-m-d H:i', ($appoint_case['appoint_time']))->timestamp;
                $appoint_case['guest_id'] =  auth_user()->id;

                if(array_key_exists('is_del',$appoint_case)){

                  $delete =   $this->repository->delete($appoint_case['id']);

                  if(!$delete){

                      \DB::rollback();

                      return false;
                  }

                }elseif(array_key_exists('id',$appoint_case)){

                    $update =  $this->repository->update($appoint_case,$appoint_case['id']);

                    if(!$update){

                        \DB::rollback();

                        return false;
                    }

                }else{

                    $appoint_case['appoint_id'] =  Apiato::call('Appoint@FindAppointByIdTask', [$appoint_case['appoint_id']])->id;
                    $create_appoint_case = $this->repository->create($appoint_case);

                    if(!$create_appoint_case){

                        \DB::rollback();

                        return false;
                    }

                }
            }

            \DB::commit();

            return true;

        } catch (Exception $exception) {

            \DB::rollback();
            report($exception);
            throw new CreateResourceFailedException();
        }
    }
}
