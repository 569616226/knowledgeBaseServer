<?php

namespace App\Containers\Group\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateGroupAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'name'
        ]);

        return Apiato::call('Group@UpdateGroupTask', [$request->id, $data]);

    }
}
