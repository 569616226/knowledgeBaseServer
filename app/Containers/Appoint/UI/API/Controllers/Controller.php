<?php

namespace App\Containers\Appoint\UI\API\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Appoint\UI\API\Requests\ChangeAppointStatusRequest;
use App\Containers\Appoint\UI\API\Requests\CreateAppointRequest;
use App\Containers\Appoint\UI\API\Requests\DeleteAppointRequest;
use App\Containers\Appoint\UI\API\Requests\FindAppointByIdRequest;
use App\Containers\Appoint\UI\API\Requests\FindGuestAppointByIdRequest;
use App\Containers\Appoint\UI\API\Requests\GetAllAppointRequest;
use App\Containers\Appoint\UI\API\Requests\GetGuestComplateAppointsRequest;
use App\Containers\Appoint\UI\API\Requests\GetGuestNoComplateAppointsRequest;
use App\Containers\Appoint\UI\API\Requests\GetLinkaAppointsRequest;
use App\Containers\Appoint\UI\API\Requests\GetLinkaComplateAppointsRequest;
use App\Containers\Appoint\UI\API\Requests\GetLinkaNoComplateAppointsRequest;
use App\Containers\Appoint\UI\API\Requests\SelectAppointCaseRequest;
use App\Containers\Appoint\UI\API\Requests\UpdateAppointRequest;
use App\Containers\Appoint\UI\API\Transformers\AppointTransformer;
use App\Containers\Appoint\UI\API\Transformers\GuestAppointTransformer;
use App\Containers\Appoint\UI\API\Transformers\GuestListAppointTransformer;
use App\Containers\Appoint\UI\API\Transformers\NoAppraiseAppointTransformer;
use App\Ship\Parents\Controllers\ApiController;

/**
 * Class Controller
 *
 * @package App\Containers\Appoint\UI\API\Controllers
 */
class Controller extends ApiController
{
    /**
     * @param CreateAppointRequest $request
     * @return array
     */
    public function createAppoint(CreateAppointRequest $request)
    {
        $appoint = Apiato::call('Appoint@CreateAppointAction', [$request]);

        return $this->transform($appoint, AppointTransformer::class);
    }

    /**
     * @param FindAppointByIdRequest $request
     * @return array
     */
    public function findAppointById(FindAppointByIdRequest $request)
    {
        $appoint = Apiato::call('Appoint@FindAppointByIdAction', [$request]);

        return $this->transform($appoint, AppointTransformer::class);
    }

    /**
     * @param ChangeAppointStatusRequest $request
     * @return array
     */
    public function changeAppointStatus(ChangeAppointStatusRequest $request)
    {
        return Apiato::call('Appoint@ChangeAppointStatusAction', [$request]);
    }

    /**
     * @param ChangeAppointStatusRequest $request
     * @return array
     */
    public function selectAppointCase(SelectAppointCaseRequest $request)
    {
        $appoint = Apiato::call('Appoint@SelectAppointCaseAction', [$request]);

        return $this->transform($appoint, AppointTransformer::class);
    }

    /**
     * @param FindAppointByIdRequest $request
     * @return array
     */
    public function findGuestAppointById(FindGuestAppointByIdRequest $request)
    {
        $appoint = Apiato::call('Appoint@FindAppointByIdAction', [$request]);

        return $this->transform($appoint, AppointTransformer::class);
    }

    /**
     * @param GetAllAppointRequest $request
     * @return array
     */
    public function getAllAppoints(GetAllAppointRequest $request)
    {
        $appoints = Apiato::call('Appoint@GetAllAppointsAction');

        return $this->transform($appoints, AppointTransformer::class);
    }

    /**
     * @param GetGuestComplateAppointsRequest $request
     * @return array
     */
    public function getGuestComplateAppoints(GetGuestComplateAppointsRequest $request)
    {
        $appoints = Apiato::call('Appoint@GetGuestComplateAppointsAction');

        return $this->transform($appoints, GuestListAppointTransformer::class);
    }

    /**
     * @param GetGuestNoComplateAppointsRequest $request
     * @return array
     */
    public function getGuestNoComplateAppoints(GetGuestNoComplateAppointsRequest $request)
    {
        $appoints = Apiato::call('Appoint@GetGuestNoComplateAppointsAction');

        return $this->transform($appoints, GuestListAppointTransformer::class);
    }

    /**
     * @param GetLinkaComplateAppointsRequest $request
     * @return array
     */
    public function getLinkaComplateAppoints(GetLinkaComplateAppointsRequest $request)
    {
        $appoints = Apiato::call('Appoint@GetLinkaComplateAppointsAction');

        return $this->transform($appoints, GuestAppointTransformer::class);
    }

    /**
     * @param GetLinkaNoComplateAppointsRequest $request
     * @return array
     */
    public function getLinkaNoComplateAppoints(GetLinkaNoComplateAppointsRequest $request)
    {
        $appoints = Apiato::call('Appoint@GetLinkaNoComplateAppointsAction');

        return $this->transform($appoints, GuestAppointTransformer::class);
    }

    /**
     * @param UpdateAppointRequest $request
     * @return array
     */
    public function updateAppoint(UpdateAppointRequest $request)
    {
        $appoint = Apiato::call('Appoint@UpdateAppointAction', [$request]);

        return $this->transform($appoint, AppointTransformer::class);
    }


}
