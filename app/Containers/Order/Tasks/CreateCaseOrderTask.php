<?php

namespace App\Containers\Order\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Order\Data\Repositories\OrderRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateCaseOrderTask extends Task
{

    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {

        try {

            $payment = \EasyWeChat::payment(); // 微信支付
            $open_id = auth_user()->open_id;

            /*测试使用的open_id,强行写死*/
            if (env('APP_ENV') == 'testing') {
                $open_id = 'oy_pR0RDamfo4Yh35rQ4Nvhid10o';
            }

            $wechat_order_data = [
                'partner_trade_no' => create_order_number(), // 商户订单号，需保持唯一性(只能是字母或者数字，不能包含有符号)
                'openid'           => $open_id,
                'check_name'       => 'NO_CHECK', // NO_CHECK：不校验真实姓名, FORCE_CHECK：强校验真实姓名
                're_user_name'     => '王小帅', // 如果 check_name 设置为FORCE_CHECK，则必填用户真实姓名
                'amount'           => $data['price'] * 100, // 企业付款金额，单位为分
                'desc'             => '提现', // 企业付款操作说明信息。必填
            ];

            $result = $payment->transfer->toBalance($wechat_order_data);

            if ($result['return_code'] === 'SUCCESS' && $result['return_msg'] === 'OK') {

                return $this->getWallets(true);

            } elseif ($result['return_code'] === 'SUCCESS' && $result['return_msg'] === 'NO_AUTH') {

                /*
                 * 暫時完成提現操作，但是微信那邊沒有開通 相關功能，會提示沒有權限
                 * */

                return $this->getWallets($data, $result['err_code_des']);

            }else{

                return simple_respone(false);

            }

        } catch (Exception $exception) {

            report($exception);
            throw new CreateResourceFailedException();

        }
    }

    /*
     * 體現操作
     *
     * 減去錢包零錢，體現到微信錢包。增加收入記錄一條
     *
     * */
    protected function getWallets($data, $msg = null)
    {
        $order = $this->repository->create($data);

        if ($order && auth_user()->wallets >= 100) {//大于100才能提现余额

            auth_user()->wallets -= $data['price'];
            auth_user()->save();

            /*
             * 生成提现记录
             *
             * 交易类型
             * 0: 回答问题收入
             * 1：约见学员收入
             * 2：约见大咖收入
             * 3：问答被查看收入
             * 4：收到违约金
             * 5：提现金额
             * */
            Apiato::call('Finace@CreateFinaceTask', [
                [
                    'name'       => '提现金额',
                    'order_name' => $order->name,
                    'guest_id'   => auth_user()->id,
                    'order_no'   => create_order_number(),
                    'price'      => $order->price,
                    'type'       => 5,
                ]
            ]);

            return $msg ? simple_respone(false, $msg) : simple_respone(true);

        } else {

            return simple_respone(false, '零钱大于100才能提现余额');

        }
    }
}
