<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllArticlesAction extends Action
{
    public function run()
    {
        $articles = Apiato::call('Article@GetAllArticlesTask',[true],[
            'order_by_updated_at'
        ]);

        return $articles;
    }
}
