<?php

namespace App\Containers\Chat\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Chat\Models\Chat;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class FindChatByIdAction extends Action
{
    public function run(Request $request)
    {
        $chats = Apiato::call('Chat@FindChatByIdTask',[ $request->guest_id]);

        Chat::whereIn('id', array_pluck($chats,'id'))->update(['is_read' => 1]);

        return $chats;
    }
}

