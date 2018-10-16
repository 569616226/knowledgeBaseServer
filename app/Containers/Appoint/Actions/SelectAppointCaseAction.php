<?php

namespace App\Containers\Appoint\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class SelectAppointCaseAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'case_id'
        ]);

        $appoint = Apiato::call('Appoint@UpdateAppointTask', [$request->id, $data]);

        return $appoint;
    }
}
