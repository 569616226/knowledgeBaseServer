<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteGuestAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Guest@DeleteGuestTask', [$request->id]);
    }
}
