<?php

namespace App\Containers\Appoint\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateAppointAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'topic_id' => $request->topic_id,
            'answers'  => $request->answers,
            'profile'  => $request->profile,
            'guest_id' => auth_user()->id,
            'status'   => 2,//创建后状态变成待确认
        ];

        return Apiato::call('Appoint@CreateAppointTask', [$data]);

    }
}
