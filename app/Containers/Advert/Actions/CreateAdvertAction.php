<?php

namespace App\Containers\Advert\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateAdvertAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'name'    => $request->name,
            'path'    => $request->path,
            'type'    => $request->type,
            'order'   => $request->order,
            'url'     => $request->url,
            'user_id' => $request->user()->id
        ];

        return Apiato::call('Advert@CreateAdvertTask', [$data]);
    }
}
