<?php

namespace App\Containers\Chat\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetAllChatsAction extends Action
{
    public function run(Request $request)
    {
        return auth_user()->chats()->where('is_last',1)->orderBy('created_at','desc')->paginate();
    }
}
