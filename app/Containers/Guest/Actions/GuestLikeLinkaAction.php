<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GuestLikeLinkaAction extends Action
{
    public function run(Request $request)
    {

        $auth_guest_like_linka_ids = auth_user()->like_linkas ?? [];

        $linka_id = $request->get('linka_id');

        $data = push_or_pull_array_value($auth_guest_like_linka_ids, $linka_id);

        $guest = Apiato::call('Guest@UpdateGuestTask', [auth_user()->id, ['like_linkas' => $data]]);


        return $guest;
    }
}
