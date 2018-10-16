<?php

namespace App\Containers\Appoint\Actions;

use App\Containers\Appoint\Models\Appoint;
use App\Ship\Parents\Actions\Action;

class GetLinkaNoComplateAppointsAction extends Action
{
    public function run()
    {
        $topics = auth_user()->topics;
        $appoint_ids = [];
        foreach ($topics as $topic) {
            $appointIds = $topic->appoints->pluck('id')->toArray();
            $appoint_ids = array_merge($appoint_ids, $appointIds);
        }

        $appoints = Appoint::whereIn('id', $appoint_ids)->orderBy('created_at','desc')->whereNotIn('status',[0,5,6])->paginate();

        return $appoints;
    }
}
