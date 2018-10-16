<?php

namespace App\Containers\AppointAppraise\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateAppointAppraiseAction extends Action
{
    public function run(Request $request)
    {
        $appoint = Apiato::call('Appoint@FindAppointByIdTask', [$request->id]);
        $data = [
            'star'       => $request->star,
            'degree'     => $request->degree,
            'content'    => $request->get('content'),
            'appoint_id' => $appoint->id,
            'guest_id'   => auth_user()->id,
        ];

        $appointappraise = Apiato::call('AppointAppraise@CreateAppointAppraiseTask', [$appoint->id,$data]);

        return $appointappraise;
    }
}
