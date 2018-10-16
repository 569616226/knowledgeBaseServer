<?php

namespace App\Containers\Menu\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindMenuByIdAction extends Action
{
    public function run(Request $request)
    {
        $menu = Apiato::call('Menu@FindMenuByIdTask', [$request->id]);

        return $menu;
    }
}
