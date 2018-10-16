<?php

namespace App\Containers\Nav\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetNavAnswersAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'order_by'   => $request->order_by,//列表排序 默认排序0：1人气最高,2人气最高
            'limit'      => $request->limit ?? 10,//每页个数
            'page'       => $request->page ?? 1,//页码
        ];

        return Apiato::call('Nav@GetNavAnswersTask', [$request->id,$data]);
    }
}
