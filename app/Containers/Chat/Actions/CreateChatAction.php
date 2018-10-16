<?php

namespace App\Containers\Chat\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateChatAction extends Action
{
    public function run(Request $request)
    {

        $data = [
            'content' => request('content'),
            'is_read' => 0,
            'pid'     => request('pid') ?? 0,
        ];

        return Apiato::call('Chat@CreateChatTask', [request('guest_id'), $data]);
    }
}
