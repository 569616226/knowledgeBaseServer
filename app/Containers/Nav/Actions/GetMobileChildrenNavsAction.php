<?php

namespace App\Containers\Nav\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetMobileChildrenNavsAction extends Action
{
    public function run()
    {
        $navs = Apiato::call('Nav@GetAllNavsTask',[true],[
            'ordered',
            'children',
        ]);

        return $navs;
    }
}
