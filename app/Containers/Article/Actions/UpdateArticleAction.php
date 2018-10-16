<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateArticleAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'title'   => $request->title,
            'content' => htmlentities(addslashes($request->get('content'))),
            'cover'   => $request->cover,
            'status'  => 2,
        ];

        return Apiato::call('Article@UpdateArticleTask', [$data, $request->id]);
    }
}
