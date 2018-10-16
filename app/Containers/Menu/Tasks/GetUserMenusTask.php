<?php

namespace App\Containers\Menu\Tasks;

use App\Ship\Parents\Requests\Request;
use App\Ship\Parents\Tasks\Task;

class GetUserMenusTask extends Task
{

    public function run(Request $request)
    {

        return $request->user()->menus;
    }

}
