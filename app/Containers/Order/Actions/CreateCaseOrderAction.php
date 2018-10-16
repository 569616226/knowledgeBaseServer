<?php

namespace App\Containers\Order\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

class CreateCaseOrderAction extends Action
{
    public function run(Request $request)
    {

        $data = [

            'answer_type'   => null,//问题订单类型 0：提问， 1：查看
            'name'          => auth_user()->name . '提现订单',
            'price'         => $request->price,
            'guest_id'      => auth_user()->id,
            'order_no'      => create_order_number(), //生成订单号
            'pay_type'      => 0,//支付方式 0微信支付
            'cancel_res'    => null,//取消原因
            'payee'         => null,//收款人
            'is_cancel'     => false,// 违约金订单 true /false
            'refund_way'    => 0,
            'refund_status' => 2,

        ];

        return Apiato::call('Order@CreateCaseOrderTask', [$data]);//创建订单和发起微信支付

    }
}
