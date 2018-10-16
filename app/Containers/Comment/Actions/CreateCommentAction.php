<?php

namespace App\Containers\Comment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateCommentAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'content'    => htmlentities(addslashes($request->get('content'))),
            'guest_id'   => auth_user()->id,
            'article_id' => $request->id,
        ];

        return Apiato::call('Comment@CreateCommentTask', [$data]);
    }
}
