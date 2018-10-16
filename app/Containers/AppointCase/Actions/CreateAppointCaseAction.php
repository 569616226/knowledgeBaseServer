<?php

namespace App\Containers\AppointCase\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateAppointCaseAction extends Action
{
    public function run(Request $request)
    {

        return  Apiato::call('AppointCase@CreateAppointCaseTask', [$request->appoint_cases]);

    }
}
