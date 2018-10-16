<?php

namespace App\Containers\Nav\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateNavAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'name'    => $request->name,
            'icon'    => $request->icon,
            'pid'     => $request->pid ?? 0,
            'user_id' => $request->user()->id,
        ];

        $nav = Apiato::call('Nav@CreateNavTask', [$data]);

        return $nav;
    }
}
