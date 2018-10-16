<?php

namespace App\Containers\Appoint\Tasks;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Appoint\Models\Appoint;
use App\Containers\Order\Models\Order;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\Cache;
use Exception;

class ChangeAppointStatusTask extends Task
{

    public function run($id, array $data)
    {

        if (in_array($data['status'], [0, 6])) {//取消拒绝约见

            $appoint_data = [
                'cancel_res' => $data['cancel_res'],
                'canceler'   => auth_user()->name,
            ];

        }

        /*
         * 初始化数据
         * wechat_jsdk_config 微信支付配置
         * title 微信消息標題
         * toUser 消息接收用戶
         * url 消息跳轉url
         *
         * */
        try {

            $appoint = Appoint::find($id);

            $wechat_jsdk_config = null;//微信支付配置

            $url = env('APP_MOBILE_URL') . '/#/makedaka/initiatingRemove/' . $appoint->getHashedKey();//微信模板消息内容url
            $temp_id = config('appoint-container.wechat_appoint_temp_id');
            $type_name = '话题约见';
            $type_title = $appoint->topic->title;

            $toUser = null;
            $remark = null;
            $title = null;


            switch ($data['status']) {

                //0：已关闭/取消，1：待付款 ，2：待确认 ，3：待见面，4：待评价，5：已完成，6：已拒绝
                case 0:

                    /*
                    * 如果订单已经付款  创建违约金订单
                    *
                    * 如果没有付款直接取消
                    *
                    * */
                    if ($appoint->orders->count() && $appoint->orders()->first()->status == 1 && $appoint->orders()->first()->pay_time ) {

                        $cancel_order = Order::where('cancel_appoint_id', $appoint->orders->first()->id)->first();

                        /*
                         * 如果已经生成取消订单
                         *
                         * 直接生成支付配置
                        */
                        if ($cancel_order) {

                            $wechat_jsdk_config = wechat_payment($cancel_order->order_no, $cancel_order->price);

                        } else {

                            $wechat_jsdk_config = create_orders($appoint, null, true); //创建违约金订单

                        }

                    } else {//直接取消訂單

                        $appoint_data['status'] = $data['status'];

                        if (auth_user()->id === $appoint->topic->guest->id) {

                            /*微信通知信息*/
                            $title = '大咖取消本次预约，取消原因：' . $data['cancel_res'];
                            $toUser = $appoint->guest;
                            $remark = '大咖已经取消您的约见请求，请进入网站查看详情';

                        } elseif (auth_user()->id === $appoint->guest->id) {

                            /*微信通知信息*/
                            $title = '学员取消本次预约，取消原因：' . $data['cancel_res'];
                            $toUser = $appoint->topic->guest;
                            $remark = '学员已经取消您的约见请求，请进入网站查看详情';
                        }

                    }

                    break;

                case 1:

                    $appoint_data['status'] = $data['status'];

                    //是不是第一次预见这个大咖
                    $first_appoint_chat = 'first_appoint_chat_' . auth_user()->id . 'to' . $appoint->guest->id;
                    $is_first_send = Cache::get($first_appoint_chat);

                    if (!$is_first_send) {//不是第一次约见

                        /*大咖确认约见，发送一条私信到约见人*/
                        $chat_data = [
                            'content' => '您好，我是' . auth_user()->real_name . '。我们可以通过私信进行沟通约见的细节！',
                            'is_read' => 0,
                            'pid'     => 0,
                        ];

                        Apiato::call('Chat@CreateChatTask', [$appoint->guest->id, $chat_data]);

                        Cache::forever($first_appoint_chat, $chat_data);

                    }

                    break;

                case 2:

                    /*修改预约状态*/
                    $appoint_data['status'] = $data['status'];

                    /*微信通知信息*/
                    $title = '大咖已接受您的预约，快选个时间地点见面吧！';
                    $toUser = $appoint->guest;
                    $remark = $title;

                    break;


                case 3:
                    /*
                    * 用户付款 状态变成 待见面
                    * return array 微信支付配置
                    *
                    * 确认约见方案
                    */

                    $appoint->case_id = $data['cases_id'];
                    $appoint->save();

                    /*
                     * 如果第一次支付 ，生产约见订单
                     * 如果不是，就直接生产微信订单配置（用户第一次取消支付，再次支付）
                     *
                     * */
                    if (!$appoint->orders->count()) {

                        $wechat_jsdk_config = create_orders($appoint); //创建预约订单

                    } else {

                        $appoint_order = $appoint->orders()->first();

                        $wechat_jsdk_config = wechat_payment($appoint_order->order_no, $appoint_order->price);

                    }

                    break;

                case 4:

                    $appoint_data['status'] = $data['status'];

                    $title = '邀请您对此次会面进行评价，分享会面心得吧！';
                    $toUser = $appoint->guest;
                    $remark = $title;

                    break;

                case 5:

                    $appoint_data['status'] = $data['status'];

                    break;

                case 6:

                    /*修改预约状态*/
                    $appoint_data['status'] = $data['status'];

                    /*微信通知信息*/
                    $title = '大咖拒绝本次预约，拒绝原因：' . $data['cancel_res'];
                    $toUser = $appoint->guest;
                    $remark = '大咖已经拒绝了您的约见请求，请进入网站查看详情';

                    break;

            }

            /*如果没有内容就不发送*/
            if ($toUser && $title && $remark) {

                send_wechat_temp_msg($toUser, $temp_id, $url, $title, $type_name, $type_title, $remark);//微信审核消息

            }

            /*更新约见状态*/
            $appoint_data['status_times'][$data['status']] = now()->toDateTimeString();//约见状态时间 ['状态' => '状态变化的时间' ]
            $appoint->update($appoint_data);
            $appoint->save();

            /*如果是付款和取消要生成微信支付配置*/
            if ($wechat_jsdk_config) {

                $wechat_jsdk_config['appoint_id'] = $appoint->getHashedKey();

                return $wechat_jsdk_config;

            } else {

                return simple_respone($appoint);

            }

        } catch (Exception $exception) {

            report($exception);
            throw new UpdateResourceFailedException();

        }
    }
}
