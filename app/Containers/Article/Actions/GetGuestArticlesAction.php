<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetGuestArticlesAction extends Action
{
    public function run()
    {
        return Apiato::call('Article@GetAllArticlesTask', [],[
            'ordered',
            'guests',
        ]);
    }
}
