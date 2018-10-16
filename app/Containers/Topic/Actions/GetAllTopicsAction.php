<?php

namespace App\Containers\Topic\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllTopicsAction extends Action
{
    public function run()
    {
        $topics = Apiato::call('Topic@GetAllTopicsTask',[true],[
            'order_by_updated_at'
        ]);

        return $topics;
    }
}
