<?php

namespace App\Containers\Nav\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class MobileFindNavByIdAction extends Action
{
    public function run(Request $request)
    {
        $nav = Apiato::call('Nav@FindNavByIdTask', [$request->id]);

        return $nav;
    }
}
