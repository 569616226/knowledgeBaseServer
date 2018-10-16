<?php

namespace App\Containers\Order\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllCaseOrdersAction extends Action
{
    public function run()
    {
        $orders = Apiato::call('Order@GetAllOrdersTask', [true], [
            'ordered',
            'cases',
        ]);

        return $orders;
    }
}
