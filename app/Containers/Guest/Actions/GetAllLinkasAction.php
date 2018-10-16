<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllLinkasAction extends Action
{
    public function run()
    {
        $linkas = Apiato::call('Guest@GetAllGuestsTask', [true], [
            'ordered',
            'linkas'
        ]);

        return $linkas;
    }
}
