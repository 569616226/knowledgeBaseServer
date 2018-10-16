<?php

namespace App\Containers\AppointCase\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppointCase\UI\API\Requests\CreateAppointCaseRequest;
use App\Containers\AppointCase\UI\API\Requests\DeleteAppointCaseRequest;
use App\Containers\AppointCase\UI\API\Requests\FindAppointCaseByIdRequest;
use App\Containers\AppointCase\UI\API\Requests\UpdateAppointCaseRequest;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\AppointCase\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateAppointCaseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAppointCase(CreateAppointCaseRequest $request)
    {
        $appointcase = Apiato::call('AppointCase@CreateAppointCaseAction', [$request]);

        return simple_respone($appointcase);
    }

}
