<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class MobileFindArticleByIdAction extends Action
{
    public function run(Request $request)
    {
        $article = Apiato::call('Article@FindArticleByIdTask', [$request->id]);

        if ($article) {

            $readers = $article->readers;
            Apiato::call('Article@UpdateArticleTask', [['readers' => $readers + 1], $request->id]);

        }

        return $article;
    }
}
