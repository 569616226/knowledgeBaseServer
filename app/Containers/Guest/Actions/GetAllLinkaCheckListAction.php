<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllLinkaCheckListAction extends Action
{
    public function run()
    {
        $linkas = Apiato::call('Guest@GetAllGuestsTask', [true], [
            'order_by_aduit_time',
            'linka_check_list'
        ]);

        return $linkas;
    }
}
