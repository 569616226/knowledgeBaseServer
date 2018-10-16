<?php

namespace App\Containers\Guest\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class ToBeLinkaAction extends Action
{
    public function run(Request $request)
    {

        $data = $request->sanitizeInput([
            'real_name',
            'phone',
            'email',
            'city',
            'single_profile',
            'office',
            'cover',
            'location',
            'card_id',
            'card_pic',
            'referee',
            'we_name',
        ]);

        $data['status'] = 2;

        $linka = Apiato::call('Guest@UpdateGuestTask', [auth_user()->id, $data]);

        //设置大咖分类
        $navs = $request->get('navs');
        $linka->navs()->sync($navs);

        return $linka;
    }
}
