<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class SyncGuestGroupsAction extends Action
{
    public function run(Request $request)
    {

        $guest = Apiato::call('Guest@FindGuestByIdTask', [$request->guest_id]);

        // convert groups IDs to array (in case single id passed)
        if (!is_array($groupsIds = $request->groups_ids)) {
            $groupsIds = [$request->groups_ids];
        }

        $guest->groups()->sync($groupsIds);

        return $guest;
    }
}
