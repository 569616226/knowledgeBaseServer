<?php

namespace App\Containers\Appoint\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class ChangeAppointStatusAction extends Action
{
    public function run(Request $request)
    {

        $data = $request->sanitizeInput(['status','cancel_res','cases_id']);

        return Apiato::call('Appoint@ChangeAppointStatusTask',[$request->id,$data]);
    }
}
