<?php

namespace App\Containers\Nav\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteNavAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Nav@DeleteNavTask', [$request->id]);
    }
}
