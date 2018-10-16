<?php

namespace App\Containers\Answer\Actions;

use App\Ship\Parents\Actions\Action;

class GetAllGuestAnswersAction extends Action
{
    public function run()
    {
        $answers = auth_user()->my_answers()->orderBy('created_at','desc')->paginate();

        return $answers;
    }
}
