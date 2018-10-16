<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class LikeArticleAction extends Action
{
    public function run(Request $request)
    {

        $article = Apiato::call('Article@FindArticleByIdTask', [$request->id]);
        $like_guest_ids = $article->like ?? [];

        array_push($like_guest_ids, auth_user()->id);

        $data = [
            'like' => array_unique($like_guest_ids),
        ];

        $like_article = Apiato::call('Article@UpdateArticleTask', [$data, $request->id]);

        return simple_respone(in_array(auth_user()->id, $like_article->like));
    }
}
