<?php

namespace App\Containers\Home\Actions;

use App\Containers\Answer\Models\Answer;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class SearchMobileAnswerDataAction extends Action
{
    public function run(Request $request)
    {
        $search_text = $request->search_text;

        $answers = Answer::where('name','like','%'.$search_text.'%')->paginate();

        return $answers;

    }
}
