<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class UpdateGuestAction extends Action
{
    public function run(Request $request)
    {

        $data = $request->sanitizeInput([
            'name',
            'real_name',
            'avatar',
            'phone',
            'email',
            'we_name',
            'city',
            'single_profile',
            'office',
            'cover',
            'location',
            'card_id',
            'card_pic',
            'referee',
            'remark',
            'profile',
            'gender'
        ]);

        if(array_key_exists('profile', $data)){
            $data['profile'] =  htmlentities(addslashes($data['profile']));
        }

        $guest = Apiato::call('Guest@UpdateGuestTask', [$request->id, $data]);

        if($request->nav_ids){
            $guest->navs()->sync($request->nav_ids);
        }

        return $guest;
    }
}
