<?php

namespace App\Containers\Message\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllMessagesAction extends Action
{
    public function run()
    {
        $messages = Apiato::call('Message@GetAllMessagesTask', [true], [
            'ordered',
            'groups'
        ]);

        return $messages;
    }
}
