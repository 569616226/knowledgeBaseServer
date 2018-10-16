<?php

namespace App\Containers\Guest\Actions;

use App\Ship\Parents\Actions\Action;

class GetGuestLikeLinkasAction extends Action
{
    public function run()
    {
        $linkas = auth_user()->guest_like_linkas;

        return $linkas;
    }
}
