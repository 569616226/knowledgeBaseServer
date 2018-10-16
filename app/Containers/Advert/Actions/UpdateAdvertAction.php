<?php

namespace App\Containers\Advert\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateAdvertAction extends Action
{
    public function run(Request $request)
    {

        $data = [
            'name'    => $request->name,
            'path'    => $request->path,
            'type'    => $request->type,
            'order'   => $request->order,
            'url'     => $request->url,
        ];


        return Apiato::call('Advert@UpdateAdvertTask', [$request->id, $data]);
    }
}
