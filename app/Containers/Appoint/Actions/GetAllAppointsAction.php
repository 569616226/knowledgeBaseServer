<?php

namespace App\Containers\Appoint\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllAppointsAction extends Action
{
    public function run()
    {
        $appoints = Apiato::call('Appoint@GetAllAppointsTask',[true],[
            'ordered'
        ]);

        return $appoints;
    }
}
