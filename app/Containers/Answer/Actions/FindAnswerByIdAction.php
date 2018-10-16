<?php

namespace App\Containers\Answer\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindAnswerByIdAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Answer@FindAnswerByIdTask', [$request->id]);
    }
}
