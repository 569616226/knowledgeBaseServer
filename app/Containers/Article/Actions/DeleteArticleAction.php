<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteArticleAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Article@DeleteArticleTask', [$request->id]);
    }
}
