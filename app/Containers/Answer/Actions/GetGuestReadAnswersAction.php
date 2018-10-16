<?php

namespace App\Containers\Answer\Actions;

use App\Ship\Parents\Actions\Action;

class GetGuestReadAnswersAction extends Action
{
    public function run()
    {
        $answers = auth_user()->read_answers()->orderBy('created_at','desc')->paginate();

        return $answers;
    }
}
