<?php

namespace App\Containers\Topic\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteTopicAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Topic@DeleteTopicTask', [$request->id]);
    }
}
