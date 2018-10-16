<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class SyncGuestNavsAction extends Action
{
    public function run(Request $request)
    {

        $guest = Apiato::call('Guest@FindGuestByIdTask', [$request->guest_id]);

        // convert navs IDs to array (in case single id passed)
        if (!is_array($navsIds = $request->navs_ids)) {
            $navsIds = [$request->navs_ids];
        }

        $guest->navs()->sync($navsIds);

        return $guest;
    }
}
