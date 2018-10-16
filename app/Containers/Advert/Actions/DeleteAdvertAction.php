<?php

namespace App\Containers\Advert\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteAdvertAction extends Action
{
    public function run(Request $request)
    {

        return Apiato::call('Advert@DeleteAdvertTask', [$request->id]);
    }
}
