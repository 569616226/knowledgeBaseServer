<?php

namespace App\Containers\Advert\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllAdvertsAction extends Action
{
    public function run()
    {
        $adverts = Apiato::call('Advert@GetAllAdvertsTask');
        return $adverts;
    }
}
