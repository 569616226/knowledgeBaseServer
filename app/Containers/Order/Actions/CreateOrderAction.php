<?php

namespace App\Containers\Order\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class CreateOrderAction extends Action
{
    public function run($data)
    {

        $order = Apiato::call('Order@CreateOrderTask', [$data]);

        return $order;
    }
}
