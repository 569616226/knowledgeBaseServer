<?php

namespace App\Containers\Appoint\Actions;

use App\Ship\Parents\Actions\Action;

class GetGuestComplateAppointsAction extends Action
{
    public function run()
    {
        $appoint_complates = auth_user()->appoints()->orderBy('created_at','desc')->whereIn('status',[0,5,6])->paginate();

        return $appoint_complates;
    }
}
