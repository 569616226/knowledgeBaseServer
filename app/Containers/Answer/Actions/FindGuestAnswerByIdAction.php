<?php

namespace App\Containers\Answer\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindGuestAnswerByIdAction extends Action
{
    public function run(Request $request)
    {

        $answer = Apiato::call('Answer@FindGuestAnswerByIdTask', [$request->id]);

        return $answer;

    }
}
