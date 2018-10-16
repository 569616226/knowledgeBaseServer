<?php

namespace App\Containers\Order\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Order\Models\Order;
use App\Ship\Parents\Actions\Action;

class WechatNotifyUrlAction extends Action
{
    public function run()
    {

        $payment = \EasyWeChat::payment(); // 微信支付

        $response = $payment->handlePaidNotify(function ($message, $fail) use ($payment) {

            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = Order::where('order_no', ($message['out_trade_no']))->first();

            if (!$order || $order->pay_time) { // 如果订单不存在 或者 订单已经支付过了
                return true; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            //建议在这里调用微信的【订单查询】接口查一下该笔订单的情况，确认是已经支付
            $result = $payment->order->queryByOutTradeNumber($message['out_trade_no']);

//            \Log::info('wechat_order_return =>', [$result]);

            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态

                try {

                    \DB::beginTransaction();

                    // 用户是否支付成功
                    if (array_get($message, 'result_code') === 'SUCCESS') {

                        $answer = $order->answer;
                        $appoint = $order->appoint;

                        if ($answer) {//问答订单

                            if ($order->answer_type == 1) { //查看問題訂單

//                                \Log::info('查看問題訂單');

                                $order->pay_time = time(); // 更新支付时间为当前时间(查看问题订单直接完成)
                                $order->status = 5;
                                $order->save(); // 保存订单

                                /*支付完成，可以查看订单*/
                                $answer->guests()->attach([$order->guest_id => ['is_reader' => 1]]);

                                $linka = $answer->question->guest;//大咖
                                $guest = $answer->creator()->first();//提问人

                                /*完成订单金额转入大咖钱包*/
                                $linka_answer_price = get_linka_see_question_price_rate() * $order->price;
                                $linka->wallets += $linka_answer_price;
                                $linka->save();

                                /*
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
                                            'name'       => '回答问题收入',
                                            'order_name' => $order->name,
                                            'guest_id'   => $linka->id,
                                            'order_no'   => create_order_number(),
                                            'price'      => $linka_answer_price,
                                            'type'       => 0,
                                        ]
                                    ]
                                );

                                /*完成订单金额转入提问人钱包*/
                                $guest_answer_price = get_guest_see_question_price_rate() * $order->price;
                                $guest->wallets += $guest_answer_price;
                                $guest->save();

                                Apiato::call('Finace@CreateFinaceTask', [
                                    [
                                        'name'       => '问答被查看收入',
                                        'order_name' => $order->name,
                                        'guest_id'   => $guest->id,
                                        'order_no'   => create_order_number(),
                                        'price'      => $guest_answer_price,
                                        'type'       => 3,
                                    ]
                                ]);


                            } else {

                                /*
                                 * 更新支付时间为当前时间(提问题订单改为已付款)
                                 * 问题改为待回答
                                 *
                                 * 发送系统提示消息
                                 * */
                                change_answer_order_status_to_1($order);

                            }

                        } elseif ($appoint) {//約見訂單

                            $url = env('APP_MOBILE_URL') . '/#/makedaka/initiatingRemove/' . $appoint->getHashedKey();
                            $type_name = '话题约见';
                            $temp_id = config('appoint-container.wechat_appoint_temp_id');

                            if ($order->is_cancel) {//違約金訂單（直接完成）

//                                \Log::info('違約金訂單（直接完成）');

                                $order->pay_time = time(); // 更新支付时间为当前时间
                                $order->status = 5;
                                $order->save(); // 保存订单

                                $linka = $order->guest;//取消人

                                if ($linka->id == $appoint->topic->guest->id) {

                                    $title = '大咖取消本次预约并交纳违约金，取消原因：' . $appoint->cancel_res;
                                    $guest = $appoint->guest;//收款人
                                    $remark = '大咖取消本次预约并交纳违约金,请前往网站查看详情';

                                } elseif ($linka->id == $appoint->guest->id) {

                                    $title = '学员取消本次预约并交纳违约金，取消原因：' . $appoint->cancel_res;
                                    $guest = $order->appoint->topic->guest;//收款人
                                    $remark = '学员取消本次预约并交纳违约金,请前往网站查看详情';

                                }

                                /*完成違約金订单金额转入大咖钱包*/
                                $cancelPrice = get_cancel_appoint_order_rate() * $order->price ;
                                $guest->wallets += $cancelPrice;
                                $guest->save();

                                Apiato::call('Finace@CreateFinaceTask', [
                                    [
                                        'name'       => '收到违约金',
                                        'order_name' => $order->name,
                                        'guest_id'   => $guest->id,
                                        'order_no'   => create_order_number(),
                                        'price'      => $cancelPrice,
                                        'type'       => 4,
                                    ]
                                ]);

                                /*
                                 * 訂單進入退款流程
                                 *
                                 * 提交退款申请后，通过调用该接口查询退款状态。
                                 * 退款有一定延时，用零钱支付的退款20分钟内到账，
                                 * 银行卡支付的退款3个工作日后重新查询退款状态。
                                 *
                                 * 查询退款订单方法：
                                 * 微信订单号 => queryByTransactionId($transactionId)
                                 * 商户订单号 => queryByOutTradeNumber($outTradeNumber)
                                 * 商户退款单号 => queryByOutRefundNumber($outRefundNumber)
                                 * 微信退款单号 => queryByRefundId($refundId)
                                 *
                                 * */
                                $appoint_order = Order::findOrFail($order->cancel_appoint_id);

                                wechat_return_order($appoint_order);//

                                /*預約狀態變爲取消*/
                                $appoint->status = 0;
                                $appoint->save();

                            } else {//其他訂單 只是已支付

//                                \Log::info('其他訂單 只是已支付');

                                $order->pay_time = time(); // 更新支付时间为当前时间
                                $order->status = 1;
                                $order->save(); // 保存订单

                                /*約見狀態變爲待見面*/
                                $appoint->status = 3;
                                $appoint->save();

                                /*微信通知信息*/
                                $title = '学员已经付款本次约见费用，请提前做好准备并准时参加！';
                                $toUser = $appoint->topic->guest;
                                $remark = '学员已经付款本次约见费用，请提前往网站查看详情！';

                            }

                            send_wechat_temp_msg($toUser, $temp_id, $url, $title,$type_name,$appoint->topic->title,$remark);//微信审核消息
                        }

                        // 用户支付失败
                    } elseif (array_get($message, 'result_code') === 'FAIL') {

                        $order->status = 6;
                        $order->save(); // 保存订单
                    }

                    \DB::commit();

                } catch (\App\Ship\Parents\Exceptions\Exception $exception) {

                    \DB::rollback();

                    report($exception);

                }


            } else {

                return $fail('通信失败，请稍后再通知我');

            }

            return true; // 返回处理完成
        });

        return $response; // return $response;
    }
}
