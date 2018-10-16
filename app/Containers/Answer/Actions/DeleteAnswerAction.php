<?php

namespace App\Containers\Answer\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteAnswerAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Answer@DeleteAnswerTask', [$request->id]);
    }
}
