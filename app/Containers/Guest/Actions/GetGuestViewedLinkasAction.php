<?php

namespace App\Containers\Guest\Actions;

use App\Ship\Parents\Actions\Action;

class GetGuestViewedLinkasAction extends Action
{
    public function run()
    {
        $linkas = auth_user()->guest_viewed_linkas;

        return $linkas;
    }
}
