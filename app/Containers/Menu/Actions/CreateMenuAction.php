<?php

namespace App\Containers\Menu\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateMenuAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'name',
            'parent_id',
            'icon',
            'url',
            'description',
        ]);

        $menu = Apiato::call('Menu@CreateMenuTask', [$data]);

        return $menu;
    }
}
