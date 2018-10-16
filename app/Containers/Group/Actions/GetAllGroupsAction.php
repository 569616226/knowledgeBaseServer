<?php

namespace App\Containers\Group\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllGroupsAction extends Action
{
    public function run()
    {
        return Apiato::call('Group@GetAllGroupsTask',[true],[
            'ordered'
        ]);

    }
}
