<?php

namespace App\Containers\Answer\Actions;

use App\Ship\Parents\Actions\Action;

class GetLinkaAnswersAction extends Action
{
    public function run()
    {
        return auth_user()->linka_no_question_answers;
    }
}
