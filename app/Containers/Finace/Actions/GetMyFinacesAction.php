<?php

namespace App\Containers\Finace\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetMyFinacesAction extends Action
{
    public function run(Request $request)
    {
        $finaces = auth_user()->finaces()->orderBy('created_at','desc')->get();

        return $finaces;
    }
}
