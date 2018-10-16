<?php

namespace App\Containers\Appoint\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindAppointByIdAction extends Action
{
    public function run(Request $request)
    {
        $appoint = Apiato::call('Appoint@FindAppointByIdTask', [$request->id]);

        return $appoint;
    }
}
