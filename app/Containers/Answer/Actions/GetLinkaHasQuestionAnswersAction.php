<?php

namespace App\Containers\Answer\Actions;

use App\Ship\Parents\Actions\Action;

class GetLinkaHasQuestionAnswersAction extends Action
{
    public function run()
    {
        return auth_user()->linka_has_question_answers;
    }
}
