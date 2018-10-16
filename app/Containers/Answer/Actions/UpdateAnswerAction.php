<?php

namespace App\Containers\Answer\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateAnswerAction extends Action
{
    public function run(Request $request)
    {
        $data = $request->sanitizeInput([
            'star'
        ]);

        return Apiato::call('Answer@UpdateAnswerTask', [$request->id, $data]);
    }
}
