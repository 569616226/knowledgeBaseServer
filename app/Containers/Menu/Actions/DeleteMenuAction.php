<?php

namespace App\Containers\Menu\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteMenuAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Menu@DeleteMenuTask', [$request->id]);
    }
}
