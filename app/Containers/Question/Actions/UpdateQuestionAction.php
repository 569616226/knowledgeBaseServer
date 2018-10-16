<?php

namespace App\Containers\Question\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateQuestionAction extends Action
{
    public function run(Request $request)
    {
        $data['content'] = $request->get('content');

        $question = Apiato::call('Answer@FindAnswerByIdTask', [$request->id])->question;

        return Apiato::call('Question@UpdateQuestionTask', [$question->id, $data]);

    }
}
