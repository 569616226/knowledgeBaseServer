<?php

namespace App\Containers\Order\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Requests\Request;

class PayNotPayOrderAction extends Action
{
    public function run(Request $request)
    {

        $answer = Apiato::call('Answer@FindAnswerByIdTask', [$request->id]);

        try{

            $answer_order = $answer->orders()->first();

            /*重新支付生产支付配置*/
            $wechat_payment = wechat_payment($answer_order->order_no, $answer_order->price);
            $wechat_payment['answer_id'] = $answer->getHashedKey();

            return $wechat_payment;

        }catch(Exception $exception){

            report($exception);

        }

    }
}
