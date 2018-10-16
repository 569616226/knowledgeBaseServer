<?php

namespace App\Containers\Order\Jobs;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Order\Models\Order;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Parents\Jobs\Job;

/**
 * Class DefaultJob
 */
class ComplateJob extends Job
{

    public function handle()
    {

        $orders = Order::whereIn('status', [1, 2])->get();

        $answer_system_order_settings = get_ansewr_order_cancel_time();//问答订单自动关闭时间
        $appoint_system_order_settings = get_appoint_order_cancel_time();//约见订单自动关闭时间

        $answer_finance_settings = get_answer_finance_settings();//问答费用转入时间
        $appoint_finance_settings = get_appoint_finance_settings();//约见费用转入时间

        /*关闭超时的问题*/
        foreach ($orders as $order) {

            if ($order->answer_id) {

                $answer = $order->answer;
                $question = $answer->question;

                /*回答过的问题*/
                if ($order->created_at->addHours($answer_system_order_settings)->timestamp <= time()) {

                    if (!$question->content) {

                        try {

                            \DB::beginTransaction();

                            if ($order->status == 1 && $order->pay_time) {//如果订单付款了，就退款

//                                \Log::info('问答订单，如果付款进入退款流程');

                                wechat_return_order($order);

                            } elseif ($order->status == 2) {//问答订单，如果没付款直接取消关闭

//                                \Log::info('问答订单，如果没付款直接取消关闭');

                                /*订单自动取消*/
                                $order->status = 0;
                                $order->save();

                                /*问答关闭 状态为2*/
                                $answer->status = 2;
                                $answer->save();
                            }

                            \DB::commit();

                        } catch (Exception $exception) {

                            \DB::rollback();
                            report($exception);

                        }

                        /*问题回答后，费用自动转入*/
                    } elseif ($question->updated_at->addHours($answer_finance_settings)->timestamp <= time()) {

//                        \Log::info('问题回答后，费用自动转入');

                        try {

                            \DB::beginTransaction();

                            /*
                            * 完成订单金额转入大咖钱包
                            * */
                            $system_create_ansewer_price = get_linka_answer_question_price_rate();//回答问题提成比例
                            $my_finace = $order->price * $system_create_ansewer_price;
                            $question->guest->wallets += $my_finace;

                            $question->guest->save();

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
                                    'guest_id'   => $question->guest->id,
                                    'order_no'   => create_order_number(),
                                    'price'      => $my_finace,
                                    'type'       => 0,
                                ]
                            ]);

                            /*完成订单*/
                            $order->status = 5;
                            $order->save();

                            \DB::commit();

                        } catch (Exception $exception) {

                            \DB::rollback();
                            report($exception);

                        }

                    }

                } elseif ($order->created_at->addMinutes(10)->timestamp <= time()) {

                    if ($order->status == 2) {//问答订单，如果没付款直接取消关闭

//                        \Log::info('问答订单，手动查询微信支付装态');

                        $payment = \EasyWeChat::payment(); // 微信支付

                        $wechat_order = $payment->order->queryByOutTradeNumber($order->order_no);

//                        \Log::info('微信返回数据',$wechat_order);

                        /*如果支付成功*/
                        if ($wechat_order['return_code'] == 'SUCCESS' && $wechat_order['return_msg'] == 'OK' && array_key_exists('trade_state',$wechat_order) && $wechat_order['trade_state'] == 'SUCCESS') {

                            /*
                              * 更新支付时间为当前时间(提问题订单改为已付款)
                              * 问题改为待回答
                              *
                              * 发送系统提示消息
                              * */
                            change_answer_order_status_to_1($order);

                        }

                    }

                }

            } elseif ($order->appoint_id) {

                $appoint = $order->appoint;

                /*
                 * 如果没有用户支付的超时，直接自动关闭
                 *
                 * */
                if ($order->created_at->addHours($appoint_system_order_settings)->timestamp <= time()) {

                    if ($order->status == 2) {

                        /*约见订单关闭*/
                        $order->status = 0;
                        $order->save();

                        /*约见关闭*/
                        $appoint->status = 0;
                        $appoint->save();

                    }
                    /*
                     * 完成的约见订单，费用到时间自动转入
                     *
                     * */
                    if ($order->status == 1 && $order->pay_time && $appoint->status == 4 && $appoint->updated_at->addHours($appoint_finance_settings)->timestamp <= time()) {

//                        \Log::info('完成约见订单金额转入大咖钱包');

                        try {

                            \DB::beginTransaction();

                            /*
                            * 完成订单金额转入大咖钱包
                            * */
                            $system_take_settings = get_appoint_price_rate();//約问提成比例
                            $my_finace = $system_take_settings * $order->price;
                            $appoint->topic->guest->wallets += $my_finace;
                            $appoint->topic->guest->save();

                            /*
                             * 交易类型
                             * 0: 回答问题收入
                             * 1：约见学员收入
                             * 2：约见大咖收入
                             * 3：问答被查看收入
                             * 4：收到违约金
                             * 4：收到违约金
                             * 5：提现金额
                             * */
                            Apiato::call('Finace@CreateFinaceTask', [
                                [
                                    'name'       => '约见学员收入',
                                    'order_name' => $order->name,
                                    'guest_id'   => $appoint->topic->guest->id,
                                    'order_no'   => create_order_number(),
                                    'price'      => $my_finace,
                                    'type'       => 0,
                                ]
                            ]);

                            /*完成订单*/
                            $order->status = 5;
                            $order->save();

                            \DB::commit();

                        } catch (Exception $exception) {

                            \DB::rollback();
                            report($exception);

                        }
                    }

                } elseif ($order->created_at->addMinutes(10)->timestamp <= time()) {

                    /*
                     *
                     * 如果微信没有返回回调信息，就手动查询微信回掉订单
                     *
                     * */
                    if ($order->status == 2) {//约见订单，如果没付款直接取消关闭

//                        \Log::info('约见订单，手动查询微信支付装态');

                        $payment = \EasyWeChat::payment(); // 微信支付
                        $wechat_order = $payment->order->queryByOutTradeNumber($order->order_no);

                        /*如果支付成功*/
                        if ($wechat_order['return_code'] == 'SUCCESS' && $wechat_order['return_msg'] == 'OK' && $wechat_order['trade_state'] == 'SUCCESS') {

                            $order->pay_time = time(); // 更新支付时间为当前时间
                            $order->status = 1;
                            $order->save(); // 保存订单

                            /*約見狀態變爲待見面*/
                            $appoint->status = 3;
                            $appoint->save();


                            /*微信通知信息*/
                            $title = '学员已经付款本次约见费用，请提前做好准备并准时参加！';
                            $toUser = $appoint->topic->guest;
                            $url = env('APP_MOBILE_URL') . '/#/pages/initiatingPay/' . $appoint->getHashedKey();
                            $type_name = '话题约见';
                            $temp_id = config('appoint-container.wechat_appoint_temp_id');

                            send_wechat_temp_msg($toUser, $temp_id, $url, $title, $type_name, $appoint->topic->title, $title);//微信审核消息

                        }

                    }

                }

            }
        }

    }

}
