<?php

namespace App\Containers\Group\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteGroupAction extends Action
{
    public function run(Request $request)
    {

        return  Apiato::call('Group@DeleteGroupTask', [$request->id]);

    }
}
