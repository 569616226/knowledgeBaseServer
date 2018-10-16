<?php

namespace App\Containers\Message\Actions;

use App\Ship\Parents\Actions\Action;

class GetGuestSystemMessagesAction extends Action
{
    public function run()
    {
        return auth_user()->messages()->orderBy('created_at','desc')->paginate();
    }
}
