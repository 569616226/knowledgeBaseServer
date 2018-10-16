<?php

namespace App\Containers\Nav\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateNavAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'name',
            'icon',
        ]);

        $nav = Apiato::call('Nav@UpdateNavTask', [$request->id, $data]);

        return $nav;
    }
}
