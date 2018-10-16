<?php

namespace App\Containers\Finace\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllFinacesAction extends Action
{
    public function run(Request $request)
    {
        $finaces = Apiato::call('Finace@GetAllFinacesTask',[true],[
            'ordered'
        ]);

        return $finaces;
    }
}
