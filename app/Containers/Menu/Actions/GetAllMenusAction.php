<?php

namespace App\Containers\Menu\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllMenusAction extends Action
{
    public function run(Request $request)
    {
        $menus = Apiato::call('Menu@GetAllMenusTask', [$request]);

        return $menus;
    }
}
