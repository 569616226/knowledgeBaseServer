<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllGuestsAction extends Action
{
    public function run()
    {
        $guests = Apiato::call('Guest@GetAllGuestsTask', [true], [
            'ordered',
            'guests',
        ]);

        return $guests;
    }
}
