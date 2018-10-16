<?php

namespace App\Containers\Answer\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;

class GetAllAnswersAction extends Action
{
    public function run()
    {
        $answers = Apiato::call('Answer@GetAllAnswersTask',[true],[
            'ordered'
        ]);

        return $answers;
    }
}
