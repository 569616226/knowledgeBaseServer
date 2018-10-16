<?php

namespace App\Containers\Topic\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateTopicAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'title',
            'describe',
            'price',
            'ser_type',
            'ser_time',
            'need_infos',
            'remark',
        ]);

        $data['status'] = 2;//更新话题，变为待审核

        $topic = Apiato::call('Topic@UpdateTopicTask', [$request->id, $data]);

        return $topic;
    }
}
