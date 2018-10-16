<?php

namespace App\Containers\Topic\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindTopicByIdAction extends Action
{
    public function run(Request $request)
    {
        $topic = Apiato::call('Topic@FindTopicByIdTask', [$request->id]);

        return $topic;
    }
}
