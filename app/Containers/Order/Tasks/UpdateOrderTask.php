<?php

namespace App\Containers\Order\Tasks;

use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateOrderTask extends Task
{

    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id, array $data)
    {

        $payment = \EasyWeChat::payment(); // 微信支付

        try {

            \DB::beginTransaction();

            $order = $this->repository->update($data, $id);

            if ($order->refund_audit_status == 1) {

               $wechat_order =  $payment->order->queryByOutTradeNumber($order->order_no);

                if($wechat_order['return_code'] == 'SUCCESS' && $wechat_order['return_msg'] == 'OK'&& $wechat_order['trade_state'] == 'SUCCESS'){

                    $return_order_no = create_order_number('lkr');//退款单号

                    // 参数分别为：商户订单号、商户退款单号、订单金额、退款金额、其他参数
                    $result = $payment->refund->byTransactionId($wechat_order['transaction_id'],$return_order_no, $order->price * 100, $order->price * 100,[]);
                    if($result['return_code'] == 'SUCCESS' && $result['return_msg'] == 'OK'){

                        $order->status = 4;
                        $order->save();

                        return simple_respone(true);

                        \DB::commit();
                    }

                }
            }

            \DB::rollBack();
            return simple_respone(false);


        } catch (Exception $exception) {
            \DB::rollBack();
            report($exception);
            throw new UpdateResourceFailedException();

        }
    }
}
