<?php

namespace App\Containers\Finace\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindFinaceByIdAction extends Action
{
    public function run(Request $request)
    {
        $finace = Apiato::call('Finace@FindFinaceByIdTask', [$request->id]);

        return $finace;
    }
}
