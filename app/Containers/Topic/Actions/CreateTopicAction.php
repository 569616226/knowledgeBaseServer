<?php

namespace App\Containers\Topic\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateTopicAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'title'      => $request->title,
            'describe'   =>  htmlentities(addslashes($request->describe)),
            'price'      => $request->price,
            'ser_type'   => $request->ser_type,
            'ser_time'   => $request->ser_time,
            'need_infos' => $request->need_infos,
            'guest_id'   => auth_user()->id,
        ];

        $topic = Apiato::call('Topic@CreateTopicTask', [$data]);

        return $topic;
    }
}
