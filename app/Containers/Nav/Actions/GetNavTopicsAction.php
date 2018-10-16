<?php

namespace App\Containers\Nav\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class GetNavTopicsAction extends Action
{
    public function run(Request $request)
    {
        $data = [
            'topic_type' => $request->ser_type,//服务类型 默认：1全国通话，0线下约见
            'order_by'   => $request->order_by,//列表排序 默认排序0：1人气最高,2最新预约,3价格最低
            'limit'      => $request->limit ?? 10,//每页个数
            'page'       => $request->page ?? 1,//页码
        ];

        return Apiato::call('Nav@GetNavTopicsTask', [$request->id,$data]);
    }
}
