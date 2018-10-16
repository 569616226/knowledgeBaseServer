<?php

namespace App\Containers\Authorization\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * Class GuestAuthorizationTrait
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
trait GuestAuthorizationTrait
{

    /**
     * @return  \App\Containers\Guest\Models\Guest|null
     */
    public function getGuest()
    {

        return Auth::user();
    }


    /**
     * @return  mixed
     */
    public function hasAdminRole()
    {
        return false;
    }
}
