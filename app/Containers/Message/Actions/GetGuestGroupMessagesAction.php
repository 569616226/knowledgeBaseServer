<?php

namespace App\Containers\Message\Actions;

use App\Ship\Parents\Actions\Action;

class GetGuestGroupMessagesAction extends Action
{
    public function run()
    {
        return auth_user()->messages()->where('msg_type', '!=', 0)->orderBy('created_at','desc')->paginate();
    }
}
