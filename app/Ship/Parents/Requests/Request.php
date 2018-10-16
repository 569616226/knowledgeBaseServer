<?php

namespace App\Ship\Parents\Requests;

use Apiato\Core\Abstracts\Requests\Request as AbstractRequest;

use App\Containers\User\Models\User;


/**
 * Class Request
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class Request extends AbstractRequest
{
    /**
     * check if a user is admin role.
     *
     * @return  bool
     */
    public function isAdmin(User $user = null)
    {
        // if not in parameters, take from the request object {$this}
        $user = $user ? : $this->user();
        return $user->hasRole('admin');
    }

    /**
     * check if a user is has permission to action.
     *
     * @return  bool
     */
    public function hasActionPermission()
    {
        return   $this->check(['hasAccess']) ||  $this->isAdmin() ;
    }
}
