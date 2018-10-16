<?php

namespace App\Containers\Order\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateSeeAnswerOrderAction extends Action
{
    public function run(Request $request)
    {

        $answer = Apiato::call('Answer@FindAnswerByIdTask',[$request->id]);

        return Apiato::call('Order@CreateSeeAnswerOrderTask',[$answer]);

    }
}
