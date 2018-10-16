<?php

namespace App\Containers\Group\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateGroupAction extends Action
{
    public function run(Request $request)
    {

        $data = [
            'name' => $request->name,
            'user_id' => $request->user()->id,
        ];

        return Apiato::call('Group@CreateGroupTask', [$data]);

    }
}
