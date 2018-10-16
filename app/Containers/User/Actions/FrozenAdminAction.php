<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FrozenAdminAction extends Action
{
    public function run(Request $request)
    {
        $admin = Apiato::call('User@FrozenAdminTask', [$request->id]);

        return $admin;
    }
}
