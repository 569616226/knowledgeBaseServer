<?php

namespace App\Containers\Home\Actions;

use App\Containers\Topic\Models\Topic;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class SearchMobileTopicDataAction extends Action
{
    public function run(Request $request)
    {
        $search_text =$request->search_text;

        $topics = Topic::where('title','like','%'.$search_text.'%')->paginate();

        return $topics;

    }
}
