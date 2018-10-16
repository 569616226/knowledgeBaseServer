<?php

namespace App\Containers\Nav\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllNavsAction extends Action
{
    public function run()
    {
        $navs = Apiato::call('Nav@GetAllNavsTask',[true],[
            'ordered',
            'parents',
        ]);

        return $navs;
    }
}
