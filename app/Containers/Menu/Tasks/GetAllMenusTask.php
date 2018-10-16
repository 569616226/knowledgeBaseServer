<?php

namespace App\Containers\Menu\Tasks;

use App\Containers\Menu\Models\Menu;
use App\Ship\Parents\Tasks\Task;

class GetAllMenusTask extends Task
{

    public function run()
    {

        $menus = Menu::where('parent_id', 0)->get();

        return $menus;
    }

}
