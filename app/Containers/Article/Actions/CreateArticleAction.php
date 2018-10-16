<?php

namespace App\Containers\Article\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateArticleAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'title'    => $request->title,
            'content'  => htmlentities(addslashes($request->get('content'))),
            'cover'    => $request->cover,
            'guest_id' => auth_user()->id,
            'status'   => 2,
            'readers'  => 0,
            'like'     => [],
        ];

        return Apiato::call('Article@CreateArticleTask', [$data]);
    }
}
