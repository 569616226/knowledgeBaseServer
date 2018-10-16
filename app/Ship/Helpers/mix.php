<?php

// Add your helper functions here...

if (!function_exists('create_order_number')) {

    /*
     *
     *  订单号
     * @return string $order_mumber
     * */
    function create_order_number($order_str = 'lk')
    {
        $order_number = $order_str;

        $order_number .= now()->year . now()->month . now()->day . now()->hour . now()->minute . now()->second . now()->timestamp;

        return $order_number;
    }
}


if (!function_exists('auth_user')) {

    /*
     * 手机用户
     * @return Guest $guest
     * */
    function auth_user()
    {
        return \Illuminate\Support\Facades\Auth::guard('mobile_api')->user();
    }
}


if (!function_exists('get_setting')) {

    /*
     *  系统设置
     * @param string $setting_key
     * @return string
     * */
    function get_setting($setting_key)
    {
        return \Apiato\Core\Foundation\Facades\Apiato::call('Settings@FindSettingByKeyTask', [$setting_key])->value;
    }
}

if (!function_exists('wechat_payment')) {

    /*
     *  成功微信订单
     * @param string $name  订单名字
     * @param string $order_no 订单号
     * @param int $price 订单价格
     * @return boolen
     * */
    function wechat_payment($order_no, $price)
    {
        if (auth_user()) {

            $payment = \EasyWeChat::payment(); // 微信支付
            $open_id = auth_user()->open_id;

            /*测试使用的oepn_id,强行写死*/
            if (env('APP_ENV') == 'testing') {
                $open_id = 'oy_pR0RDamfo4Yh35rQ4Nvhid10o';
            }

            $order_type_data = [

                'body'         => '链答-知识付费',
                'out_trade_no' => $order_no,
                'total_fee'    => $price * 100,
                'trade_type'   => 'JSAPI',
                'openid'       => $open_id,
                'notify_url'   => env('WECHAT_PAYMENT_NOTIFY_URL', 'https://qatest.elinkport.com/orders/wechat_notify_url'), // 支付结果通知网址，如果不设置则会使用配置里的默认地址'

            ];

            $result = $payment->order->unify($order_type_data);

            /*
             * "return_code" => "SUCCESS"
             * "return_msg" => "OK"
             * "appid" => "wx7ae9a304eb37baa3"
             * "mch_id" => "1490356642"
             * "nonce_str" => "zdgfzEx4ktS0uTSv"
             * "sign" => "F22CDAD0C98308EAA5B509E380B4EDF3"
             * "result_code" => "SUCCESS"
             * "prepay_id" => "wx1717053437018460025fb74a3587430207"
             * "trade_type" => "JSAPI"
             * */
            if ($result['return_code'] === 'SUCCESS' && $result['return_msg'] === 'OK' && array_key_exists('prepay_id', $result)) {

                $jssdk = $payment->jssdk;

                return $jssdk->sdkConfig($result['prepay_id']);

            }

        }

        return $result;
    }
}

if (!function_exists('create_orders')) {

    /*
     * 创建订单公用方法
     * @param Array|Appoint|Answer $order_type_data
     * @param Number|null $answer_type
     * @param String|null $orderable_type
     * @return boolen
     * */
    function create_orders($order_type_data, $answer_type = null, $is_cancel = false)
    {
        if (auth_user()) {

            $cancel_res = null;
            $payee = null;
            $cancel_appoint_id = null;
            $answer_id = null;
            $appoint_id = null;

            if ($order_type_data instanceof \App\Containers\Answer\Models\Answer) {//问答订单

                $name = $order_type_data->name;
                $answer_id = $order_type_data->id;

                if ($answer_type) {

                    $price = get_create_answer_price();//提问问题价格

                } else {

                    $price = get_see_answer_price();//查看问题价格

                }

            } elseif ($order_type_data instanceof \App\Containers\Appoint\Models\Appoint) {//约见订单

                $name = $order_type_data->topic->title;
                $appoint_id = $order_type_data->id;

                if ($is_cancel) {//违约金订单

                    $cancel_price_rate = get_appoint_order_cancel_rate();

                    $cancel_res = $order_type_data->cancel_res;
                    $payee = auth_user()->id == $order_type_data->guest_id ? $order_type_data->topic->guest->name : $order_type_data->guest->name;
                    $is_cancel = true;

                    $cancel_appoint_id = $order_type_data->orders()->first()->id;//违约金对应的约见订单

                    $price = $order_type_data->topic->price * $cancel_price_rate;

                    /*微信最小金额要求为 0.01*/
                    if ($price < 0.01) {

                        $price = 0.01;

                    }

                } else {//提现订单

                    $price = $order_type_data->topic->price;
                }

            }
        }

        $data = [
            'answer_id'         => $answer_id,
            'appoint_id'        => $appoint_id,
            'answer_type'       => $answer_type,//问题订单类型 0：提问， 1：查看
            'name'              => $name,
            'price'             => $price,
            'guest_id'          => auth_user()->id,
            'order_no'          => create_order_number(), //生成订单号
            'pay_type'          => 0,//支付方式 0微信支付
            'cancel_res'        => $cancel_res,//取消原因
            'payee'             => $payee,//收款人
            'is_cancel'         => $is_cancel,// 违约金订单 true /false
            'cancel_appoint_id' => $cancel_appoint_id,// 违约金订单 true /false
            'status'            => 2,// 违约金订单 true /false
        ];

        $result = \Apiato\Core\Foundation\Facades\Apiato::call('Order@CreateOrderAction', [$data]);//创建订单和发起微信支付

        return $result;
    }
}


if (!function_exists('simple_respone')) {

    /*
     * 简单操作返回体
     * @param boolen true | false
     * @param string msg
     * @return Response json
     * */
    function simple_respone($boolen, $msg = '操作失败')
    {
        if ($boolen) {

            return response()->json(['status' => true, 'msg' => '操作成功']);

        } else {

            return response()->json(['status' => false, 'msg' => $msg]);
        }
    }
}

if (!function_exists('send_wechat_temp_msg')) {

    /*
     * 微信模板消息
     * @param Guest $guest 消息接收人
     * @param number $temp_id 消息模板id
     * @param string $url 消息模板url
     * @param string $title 消息标题
     * @param string $type_name 消息内容类型名字
     * @param string $type_title 消息内容标题
     * @param string $remark 备注
     * @return boolen
     * */
    function send_wechat_temp_msg($guest, $temp_id, $url, $title,$type_name,$type_title,$remark)
    {

        if ( env('SEND_WECHAT_TEMP_MSG') ) {

            $wechat = \EasyWeChat::officialAccount();

            $data = [

                'first'    => $title,
                'keyword1' => $type_name,
                'keyword2' => $guest->name,
                'keyword3' => $type_title,
                'keyword4' => now()->toDateTimeString(),
                'remark'   => $remark,
            ];

            $result = $wechat->template_message->send([
                'touser'      => env('APP_ENV') === 'testing' ? env('TEST_OPEN_ID', 'ogjC0wZU5RfWW-uE2EKvVZ5GYmyU') : $guest->open_id,
                'template_id' => $temp_id,
                'url'         => $url,
                'data'        => $data,
            ]);

            /*
             *
             * 消息发送成功后，保存消息
             *
             * 'errcode' => 0,
             * 'errmsg' => 'ok',
             * 'msgid' => 291371789823541251
             *
             *  errcode :45009 超过每日最大接口调用次数
             *
             * */
            if ($result['errcode'] === 0 && $result['errmsg'] === 'ok') {

                /*
                 * $data['content'] 审核模板
                 * $data['appoint_type'] $data['appoint_title'] 约见/问答模板
                 */

                $message_data = [

                    'sender'     => '系统',
                    'group_name' => '没有标签',
                    'title'      => $title,
                    'content'    => $type_name . ':' .$type_title,
                    'msg_type'   => 0,

                ];

                try {

                    $message = app(\App\Containers\Message\Models\Message::class)->create($message_data);
                    $guest->messages()->attach([$message->id]);

                } catch (Exception $exception) {

//                    \Log::info('微信模板消息发送失败');
                    report($exception);
                }

            } else {

                \Log::info('微信模板消息发送失败');
            }
        }

    }
}

if (!function_exists('send_wechat_msg')) {

    /*
     * 微信消息
     * @param Guest $guests
     * @param array $data
     * @param boolen $msg_type
     * */
    function send_wechat_msg($guests, $data, $msg_type = null, $url = null)
    {
        $content = $data['content'];
        foreach ($guests as $guest) {

            $wechat = \EasyWeChat::officialAccount();

            $message = new EasyWeChat\Kernel\Messages\Text($content);

            $open_id = env('APP_ENV') == 'testing' ? env('TEST_OPEN_ID', 'ogjC0wZU5RfWW-uE2EKvVZ5GYmyU') : $guest->open_id;

            if ($msg_type) {

                $new_data = [
                    'title'       => $data['title'],
                    'description' => $data['content'],
                    'url'         => $url ?? env('APP_MOBILE_URL') . '/#/news',
                    'image'       => $data['img_url'],
                ];

                $new = new \EasyWeChat\Kernel\Messages\NewsItem($new_data);
                $news = new EasyWeChat\Kernel\Messages\News([$new]);

                $wechat->customer_service->message($news)->to($open_id)->send();
            } else {
                $wechat->customer_service->message($message)->to($open_id)->send();
            }

        }

    }
}

if (!function_exists('push_or_pull_array_value')) {

    /*
     * 如果数值在数组中，就从数组中删除。如果不存在就插入到数组中
     * @param array $from_data
     * @param number $value
     * @return array
     * */
    function push_or_pull_array_value($from_data, $value)
    {

        if (in_array($value, $from_data)) {

            $key = array_search($value, $from_data);
            array_pull($from_data, $key);

        } else {

            array_push($from_data, $value);

        }

        return array_values($from_data);
    }
}


if (!function_exists('wechat_return_order')) {

    /*
     * 如果数值在数组中，就从数组中删除。如果不存在就插入到数组中
     * @param Order $order
     * @return boolen ture | false
     * */
    function wechat_return_order($order)
    {
//        \Log::info('开始退款');

        $payment = \EasyWeChat::payment(); // 微信支付

        $wechat_order = $payment->order->queryByOutTradeNumber($order->order_no);

        if ($wechat_order['return_code'] == 'SUCCESS' && $wechat_order['return_msg'] == 'OK' && $wechat_order['trade_state'] == 'SUCCESS') {

//            \Log::info('返回微信订单数据');

            $return_order_no = create_order_number('lkr');//退款单号

            // 参数分别为：商户订单号、商户退款单号、订单金额、退款金额、其他参数
            $result = $payment->refund->byTransactionId($wechat_order['transaction_id'], $return_order_no, $order->price * 100, $order->price * 100, []);

            if ($result['return_code'] == 'SUCCESS' && $result['return_msg'] == 'OK') {

                $order->status = 4;
                $order->save();

//                \Log::info('订单状态改为 退款完成');

                /*订单退款后，关闭相应的问题或者约见*/
                if ($order->answer) {

                    $order->answer->status = 2;
                    $order->answer->save();

//                    \Log::info('问答状态改为 关闭');

                } elseif ($order->appoint) {

                    $order->appoint->status = 0;
                    $order->appoint->save();

//                    \Log::info('约问状态改为 关闭');

                    $get_cancel_appoint_order_rate = get_cancel_appoint_order_rate();//违约金平台提成

                    $title = '学员取消本次预约，取消原因：' . $order->appoint->cancel_res;
                    $guest = $order->appoint->topic->guest;//收款人

                    if (auth_user()) {//手动取消约见订单

                        if (auth_user()->id === $order->appoint->topic->guest->id) {

                            /*微信通知信息*/
                            $title = '大咖取消本次预约，取消原因：' . $order->appoint->cancel_res;
                            $guest = $order->appoint->guest;//收款人

                        }

                        /*完成違約金订单金额转入大咖钱包*/
                        $cancelPrice = $get_cancel_appoint_order_rate * $order->pric;

                        $guest->wallets += $cancelPrice;
                        $guest->save();

                        \Apiato\Core\Foundation\Facades\Apiato::call('Finace@CreateFinaceTask', [
                            [
                                'name'       => '收到违约金',
                                'order_name' => $order->name,
                                'guest_id'   => $guest->id,
                                'order_no'   => create_order_number(),
                                'price'      => $cancelPrice,
                                'type'       => 4,
                            ]
                        ]);

//                        \Log::info('手动取消约见订单');

                    } else {//自动取消约见订单

                        $title = '学员超时未支付，订单自动取消';
                        $guest = $order->appoint->topic->guest;//收款人

//                        \Log::info('自动取消约见订单');
                    }

                    /*微信消息发送*/
                    $url = env('APP_MOBILE_URL') . '/#/makedaka/initiatingRemove/' . $order->appoint->getHashedKey();
                    $type_name = '话题约见';
                    $temp_id = config('appoint-container.wechat_appoint_temp_id');

                    send_wechat_temp_msg($guest, $temp_id, $url, $title,$type_name,$order->appoint->topic->title,$title);//微信审核消息;//微信审核消息

                }

//                \Log::info('退款成功', [$wechat_order]);

                return true;

            } else {

                /*打印退款错误信息*/
                \Log::info('退款失败', [$result]);

            }

        } elseif ($wechat_order['trade_state'] == 'REFUND') {//订单已经退款

            /*打印退款错误信息*/
//            \Log::info('订单已经退款', [$wechat_order]);

            /*订单改为退款完成*/
            $order->status = 4;
            $order->save();

            if ($order->answer) {//关闭问答

                $order->answer->status = 2;
                $order->save();

            } elseif ($order->appoint) {//关闭约问

                $order->appoint->status = 0;
                $order->save();
            }

        }else{

            /*打印退款错误信息*/
            \Log::info('退款失败', [$wechat_order['trade_state_desc']]);

        }

        return false;
    }
}

if (!function_exists('get_appoint_order_cancel_rate')) {

    /*
     * 约见违约金比例

     * @return int
     * */
    function get_appoint_order_cancel_rate()
    {
        return get_setting('system_order_settings')[1] / 100;
    }
}

if (!function_exists('get_appoint_order_cancel_time')) {

    /*
     * 约见订单自动关闭时间

     * @return int
     * */
    function get_appoint_order_cancel_time()
    {
        return get_setting('system_order_settings')[0] ?? 1;
    }
}

if (!function_exists('get_ansewr_order_cancel_time')) {

    /*
     * 问答订单自动关闭时间

     * @return int
     * */
    function get_ansewr_order_cancel_time()
    {
        return get_setting('system_order_settings')[2] ?? 1;
    }
}

if (!function_exists('get_answer_finance_settings')) {

    /*
     * 问答费用转入时间 1
     * */
    function get_answer_finance_settings()
    {
        return get_setting('system_finance_settings')[1] ?? 1;
    }
}

if (!function_exists('get_appoint_finance_settings')) {

    /*
    * 约见费用转入时间
    * */
    function get_appoint_finance_settings()
    {
        return get_setting('system_finance_settings')[0] ?? 1;
    }
}

if (!function_exists('get_linka_answer_question_price_rate')) {

    /*
    * 大咖回答问题提成比例
    * */
    function get_linka_answer_question_price_rate()
    {
        return get_setting('system_take_settings')[1][1] / 100;
    }
}

if (!function_exists('get_linka_see_question_price_rate')) {

    /*
    * 大咖查看问题提成比例
    * */
    function get_linka_see_question_price_rate()
    {
        return get_setting('system_take_settings')[2][1] / 100;
    }
}

if (!function_exists('get_guest_see_question_price_rate')) {

    /*
    * 提问人查看问题提成比例
    * */
    function get_guest_see_question_price_rate()
    {
        return get_setting('system_take_settings')[2][2] / 100;
    }
}


if (!function_exists('get_appoint_price_rate')) {

    /*
    * 大咖约见提成比例
    * */
    function get_appoint_price_rate()
    {
        return get_setting('system_take_settings')[0][1] / 100;
    }
}

if (!function_exists('get_see_answer_price')) {

    /*
    * 查看问题价格
    * */
    function get_see_answer_price()
    {
        return get_setting('system_answer_price_settings')[1];
    }
}

if (!function_exists('get_create_answer_price')) {

    /*
    * 提问题价格
    * */
    function get_create_answer_price()
    {
        return get_setting('system_answer_price_settings')[0];
    }
}

if (!function_exists('get_cancel_appoint_order_rate')) {

    /*
    * 違約金 收款人提成
    * */
    function get_cancel_appoint_order_rate()
    {
        return (100 - (int)get_setting('system_take_settings')[3][0]) / 100;
    }
}


if (!function_exists('change_answer_order_status_to_1')) {

    /*
    * 違約金 收款人提成
    * */
    function change_answer_order_status_to_1($order)
    {
        $order->pay_time = time(); // 更新支付时间为当前时间(提问题订单改为已付款)
        $order->status = 1;
        $order->save(); // 保存订单

        /*问题改为待回答*/
        $order->answer->status = 0;
        $order->answer->save();

        $temp_id = config('appoint-container.wechat_appoint_temp_id');
        $url = env('APP_MOBILE_URL') . '/#/user/questionReply/' . $order->answer->getHashedKey();
        $title = '收到一个新的提问，快去回答吧！';
        $type_name = '提出问题';
        $type_title = $order->answer->name;

        send_wechat_temp_msg($order->answer->question->guest, $temp_id, $url, $title,$type_name,$type_title,$title);//微信审核消息
    }
}












