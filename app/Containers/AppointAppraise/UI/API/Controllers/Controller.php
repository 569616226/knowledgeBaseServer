<?php

namespace App\Containers\AppointAppraise\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppointAppraise\UI\API\Requests\CreateAppointAppraiseRequest;
use App\Containers\AppointAppraise\UI\API\Requests\DeleteAppointAppraiseRequest;
use App\Containers\AppointAppraise\UI\API\Requests\FindAppointAppraiseByIdRequest;
use App\Containers\AppointAppraise\UI\API\Requests\GetAllAppointAppraisesRequest;
use App\Containers\AppointAppraise\UI\API\Requests\UpdateAppointAppraiseRequest;
use App\Containers\AppointAppraise\UI\API\Transformers\AppointAppraiseTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\AppointAppraise\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateAppointAppraiseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAppointAppraise(CreateAppointAppraiseRequest $request)
    {
        $result = Apiato::call('AppointAppraise@CreateAppointAppraiseAction', [$request]);

        return simple_respone($result);
    }

    /**
     * @param UpdateAppointAppraiseRequest $request
     * @return array
     */
    public function updateAppointAppraise(UpdateAppointAppraiseRequest $request)
    {
        $appointappraise = Apiato::call('AppointAppraise@UpdateAppointAppraiseAction', [$request]);

        return $this->transform($appointappraise, AppointAppraiseTransformer::class);
    }


}
