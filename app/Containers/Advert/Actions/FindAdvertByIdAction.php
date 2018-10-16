<?php

namespace App\Containers\Advert\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindAdvertByIdAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Advert@FindAdvertByIdTask', [$request->id]);
    }
}
