<?php

namespace App\Containers\Topic\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllGuestTopicsAction extends Action
{
    public function run()
    {
        $answers = Apiato::call('Topic@GetAllTopicsTask', [], [
            'ordered',
            'linkas'
        ]);

        return $answers;
    }
}
