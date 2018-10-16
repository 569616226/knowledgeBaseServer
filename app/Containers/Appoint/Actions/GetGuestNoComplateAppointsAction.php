<?php

namespace App\Containers\Appoint\Actions;

use App\Ship\Parents\Actions\Action;

class GetGuestNoComplateAppointsAction extends Action
{
    public function run()
    {
        $appoint_no_complates = auth_user()->appoints()->orderBy('created_at','desc')->whereNotIn('status',[0,5,6])->paginate();

        return $appoint_no_complates;
    }
}
