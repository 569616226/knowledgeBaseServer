<?php

namespace App\Containers\Comment\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class DeleteCommentAction extends Action
{
    public function run(Request $request)
    {
        return Apiato::call('Comment@DeleteCommentTask', [$request->id]);
    }
}
