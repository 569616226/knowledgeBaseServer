<?php

namespace App\Containers\AppointAppraise\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateAppointAppraiseAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'star',
            'degree',
            'content',
        ]);

        $appointappraise = Apiato::call('AppointAppraise@UpdateAppointAppraiseTask', [$request->id, $data]);

        return $appointappraise;
    }
}
